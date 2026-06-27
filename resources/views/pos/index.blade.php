@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-7">

        <div class="card">
            <div class="card-header">
                Produk
            </div>

            <div class="card-body">

                <div class="row">

                    @foreach ($products as $product)

                        <div class="col-md-4 mb-3">

                            <div class="card h-100">

                                <div class="card-body">

                                    <h6>{{ $product->name }}</h6>

                                    <p>
                                        Rp {{ number_format($product->price) }}
                                    </p>

                                    <p>
                                        Stok:
                                        {{ $product->stock }}
                                    </p>

                                    <form
                                        method="POST"
                                        action="{{ route('pos.add', $product->id) }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-primary w-100"
                                        >
                                            Tambah
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-5">

        <div class="card">

            <div class="card-header">
                Keranjang
            </div>

            <div class="card-body">

                @php
                    $total = 0;
                @endphp

                @forelse ($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    @endphp

                    <div class="border rounded p-2 mb-2">

                        <strong>
                            {{ $item['name'] }}
                        </strong>

                        <br>

                        Rp {{ number_format($item['price']) }}

                        <form
                            method="POST"
                            action="{{ route('pos.update', $item['id']) }}"
                            class="mt-2"
                        >
                            @csrf

                            <input
                                type="number"
                                name="qty"
                                value="{{ $item['qty'] }}"
                                min="1"
                                class="form-control mb-2"
                            >

                            <button
                                class="btn btn-warning btn-sm"
                            >
                                Update
                            </button>

                        </form>

                        <form
                            method="POST"
                            action="{{ route('pos.remove', $item['id']) }}"
                            class="mt-2"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                            >
                                Hapus
                            </button>

                        </form>

                    </div>

                @empty

                    <p>Keranjang masih kosong.</p>

                @endforelse

                <hr>

                <h5>
                    Total :
                    Rp {{ number_format($total) }}
                </h5>

            </div>

        </div>

    </div>

</div>

@endsection