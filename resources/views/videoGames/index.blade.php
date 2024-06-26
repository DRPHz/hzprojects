@extends('layouts.crud')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Video Games</h1>
        <a href="{{ route('video-games.create') }}" class="btn btn-primary">Create New Video Game</a>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Developer</th>
                <th>Release Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videoGames as $videoGame)
                <tr>
                    <td>{{ $videoGame->title }}</td>
                    <td>{{ $videoGame->genre }}</td>
                    <td>{{ $videoGame->developer }}</td>
                    <td>{{ $videoGame->release_date }}</td>
                    <td>
                        <a href="{{ route('video-games.show', $videoGame->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('video-games.edit', $videoGame->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('video-games.destroy', $videoGame->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
