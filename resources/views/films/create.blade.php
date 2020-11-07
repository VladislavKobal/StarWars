<form action="{{route('films.store')}}" method="post">
    @csrf
    <input value="{{$people_id}}" type="hidden" name="$people_id" id="$people_id">
    <label for="url">URL</label>
    <input type="text" name="url" id="url" required>
    <button type="submit">Add film</button>
</form>
