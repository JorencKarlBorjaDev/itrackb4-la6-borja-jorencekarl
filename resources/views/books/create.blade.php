@extends('layouts.app')

@section('title', 'Add Book')

@section('content')

<div class="container mt-4">

    <div class="card">
        <div class="card-body">

            <h3 class="card-title mb-4">
                Add Book
            </h3>

            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>

                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">

                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="author">Author</label>

                    <input
                        type="text"name="author" id="author" class="form-control "value="{{ old('author') }}">

                    @error('author')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="year">Year</label>

                    <input
                        type="number" name="year" id="year" class="form-control" value="{{ old('year') }}">

                    @error('year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="genre">Genre</label>

                    <select name="genre" id="genre" class="form-select">
                        <option value="">Select Genre</option>

                        <option value="History" @selected(old('genre') == 'History')>History</option>
                        <option value="Fiction" @selected(old('genre') == 'Fiction')>Fiction</option>
                    </select>

                    @error('genre')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Add Book
                </button>

                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection