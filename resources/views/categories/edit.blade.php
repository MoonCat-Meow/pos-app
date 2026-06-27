@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Edit Kategori</h4>

        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
</div>

@endsection