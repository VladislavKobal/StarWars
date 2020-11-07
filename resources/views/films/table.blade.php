<table class="table table-striped mt-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Url</th>
        <th scope="col">People</th>
    </tr>
    </thead>
    <tbody>
    @foreach($films as $film)
        <tr>
            <th scope="row">{{ $film->id }}</th>
            <td>{{ $film->url }}</td>
            <td>{{ $film->people->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

