@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
       <h3>{{ $people->name }}</h3>
       <p>{{ $people->height }}</p>
       <p><b>{{ $people->gender }}</b></p>
        <p><b>{{ $people->homeworld != null ? $people->homeworld->name : " - " }}</b></p>
        <p>{{$people->created_at}}</p>
        @include('films.create',['people_id'=>$people->id])
        @include('films.table',['films'=>$people->films])
    </div>
</div>

@endsection
