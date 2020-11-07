<?php

namespace App\Http\Controllers;

use App\Models\Homeworld;
use App\Models\Movie;
use App\Models\People;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\Factory\Iluminate\Contracts\View\View;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index($search=null, $homeworld=null): View
    {
        $peoples = People::where('name','LIKE','%'.$search.'%')->where('homeworld_id','=', $homeworld)->paginate(10);

        $homeworlds = Homeworld::all();//::distinct("name")->get();

        return view('peoples.index', compact('peoples'))->with(compact('search'))->with(compact('homeworlds'));
    }

    public function seed()  {
        $response = Http::get('https://swapi.dev/api/people/');

        if($response->status() != 200) {
            return redirect("/peoples");
        }

        $result = $response->json()["results"];

        /*
        "name": "Luke Skywalker",
            "height": "172",
            "mass": "77",
            "hair_color": "blond",
            "skin_color": "fair",
            "eye_color": "blue",
            "birth_year": "19BBY",
            "gender": "male",
            "homeworld": "http://swapi.dev/api/planets/1/",
            "films": [
                "http://swapi.dev/api/films/1/",
                "http://swapi.dev/api/films/2/",
                "http://swapi.dev/api/films/3/",
                "http://swapi.dev/api/films/6/"
            ],
         */

        foreach ($result as $people) {
            $homeworld = new Homeworld([
                "name" => $people["homeworld"],
            ]);

            $homeworld->save();
            $person = new People([
                'name' => $people["name"],
                'height' => $people["height"],
                'gender' => $people["gender"],
                'homeworld_id' => $homeworld->id,
            ]);

            $person->save();

            foreach ($people["films"] as $film) {
                $movie = new Movie([
                    'url' => $film,
                    'people_id' => $person->id,
                ]);

                $movie->save();
            }
        }

        return redirect("/peoples");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('peoples.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'height' => 'required',
            'gender' => 'required|max:255',
        ]);
        $people = new People([
            'name' => $request->get('name'),
            'height' => $request->get('height'),
            'gender' => $request->get('gender'),
        ]);

        $people->save();
        return redirect('/peoples')->with('success', 'People is add success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $people = People::find($id);
        return view('peoples.show', compact('people'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $people = People::find($id);
        return view('peoples.edit', compact('people'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        $people = People::find($id);
        if($people == null) {
            return redirect('/peoples');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            //всерівно пропускає...
            'height' => 'required|numeric',
            'gender' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('peoples/create')
                ->withErrors($validator)
                ->withInput();
        }

        $people->name = $request->get('name');
        $people->height = $request->get('height');
        $people->gender = $request->get('gender');

        $people->save();
        return redirect('/peoples')->with('success', 'People updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $people = People::find($id);

        if($people == null) {
            return redirect('/peoples');
        }

        $people->delete();
        return redirect('/peoples')->with('success', 'Peoples is deleted');
    }
}
