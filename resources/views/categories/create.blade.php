@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Tambah Kategori</h4>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Simpan</button>
        </form>

    </div>
</div>

<div class="mb-3">
    <label>Kategori</label>

    <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>

        @forelse($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ $cat->name }}
            </option>
        @empty
            <option value="">
                Belum ada kategori
            </option>
        @endforelse
    </select>
</div>

@endsection