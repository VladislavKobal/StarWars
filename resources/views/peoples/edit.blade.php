@extends('layouts.app')

@section('title', 'Edit peoples '.$people->name)

@section('content')
<div class="row">
<div class="col-lg-6 mx-auto">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('peoples.update', $people) }}">
     @csrf
     @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name"
                   value="{{ $people->name }}" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <textarea name="height" class="form-control" id="height" rows="3" type="number">{{ $people->height }}</textarea>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="male">male</option>
                <option value="female">female</option>
                <option value="n/a">n/a</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
        <form method="POST" action="{{ route('peoples.destroy', $people) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </form>
</div>
</div>
@endsection
