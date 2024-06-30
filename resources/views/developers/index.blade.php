@extends('layouts.crud')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-3xl">Developers</h1>

        <a href="{{ route('developers.create') }}" class="btn btn-primary">Create New Developer</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($developers as $developer)
                <tr>
                    <td>{{ $developer->name }}</td>
                    <td>
                        <a href="{{ $developer->website }}">{{ $developer->website }}</a>
                    </td>
                    <td>{{ $developer->bio }}</td>
                    <td>
                        <a href="{{ route('developers.show', $developer) }}" class="btn btn-info">View</a>
                        <a href="{{ route('developers.showVerifyPasswordForm', $developer) }}"
                            class="btn btn-warning">Edit</a>
                        <form action="{{ route('developers.destroy', $developer) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
