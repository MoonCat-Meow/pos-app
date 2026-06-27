@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Edit Produk</h4>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
            </div>

            <div class="mb-3">
                <label>Image (Kosongkan jika tidak ingin mengubah)</label>
                <input type="file" name="image" class="form-control">
                @if($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="100" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</div>

@endsection
