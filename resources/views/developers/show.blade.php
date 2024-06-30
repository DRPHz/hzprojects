@extends('layouts.crud')

@section('content')
    <div class="container">
        <h1 class=" text-3xl">{{ $developer->name }}</h1>
        <p><strong>Email:</strong> {{ $developer->email }}</p>
        <p><strong>Bio:</strong> {{ $developer->bio }}</p>
        <a href="{{ route('developers.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
