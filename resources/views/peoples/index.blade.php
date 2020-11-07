@extends('layouts.app')

@section('title', 'All peoples')

@section('homeworlds')
    <select name="search-homeworld" id="search-homeworld">
        <option value="null" selected>Select homeworld</option>
        @foreach($homeworlds as $homeworld)
            <option value="{{$homeworld->id}}">{{$homeworld->name}}</option>
        @endforeach
    </select>
@endsection

@section('content')
<a href="{{ route('peoples.create') }}" class="btn btn-success">Create people</a>

 @if(session()->get('success'))
    <div class="alert alert-success mt-3">
      {{ session()->get('success') }}
    </div>
@endif

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Height</th>
      <th scope="col">Gender</th>
      <th scope="col">Homeworld</th>
        <th scope="col">Films</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
   @foreach($peoples as $people)
    <tr>
      <th scope="row">{{ $people->id }}</th>
      <td>
          <a href="{{ route('peoples.show', $people) }}" class="btn btn-success">
              {{$people->name}}
          </a>
      </td>
      <td>{{ $people->height }}</td>
      <td>{{ $people->gender }}</td>
        <td>{{ $people->homeworld != null ? $people->homeworld->name : " - " }}</td>
      <td>{{ count($people->films) }}</td>
      <td class="table-buttons">
        <a href="{{ route('peoples.edit', $people) }}" class="btn btn-primary">
          <i class="fa fa-pencil" ></i>
        </a>
        <form method="POST" action="{{ route('peoples.destroy', $people) }}">
         @csrf
         @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i>
            </button>
        </form>
      </td>
    </tr>

  @endforeach
  </tbody>
</table>
{{ $peoples->links('helpers.pagination') }}
@endsection
