@extends('layouts.app')

@section('title', 'Add peoples')

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

    <form method="POST" action="{{ route('peoples.store') }}">
     @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" name="height" class="form-control" id="height">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="male">male</option>
                <option value="female">female</option>
                <option value="n/a">n/a</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add people</button>
    </form>
</div>
</div>
@endsection
