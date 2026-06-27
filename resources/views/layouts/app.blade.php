<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #111827;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center mb-4">POS SYSTEM</h4>

    <a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a>

    @role('Admin')
        <a href="/products"><i class="fa fa-box"></i> Produk</a>
        <a href="/categories"><i class="fa fa-list"></i> Kategori</a>
        <a href="/users"><i class="fa fa-users"></i> Users</a>
        <a href="/reports"><i class="fa fa-chart-line"></i> Laporan</a>
        <a href="{{ route('pos.index') }}">
    <i class="fa fa-cash-register"></i>
    POS
</a>
    @endrole

    @role('Kasir')
        <a href="/pos"><i class="fa fa-cash-register"></i> POS</a>
        <a href="/transactions"><i class="fa fa-receipt"></i> Transaksi</a>
        <a href="{{ route('pos.index') }}">
    <i class="fa fa-cash-register"></i>
    POS
</a>
        @endrole

    @role('Gudang')
        <a href="/products"><i class="fa fa-box"></i> Stok Produk</a>
    @endrole

    @role('Owner')
        <a href="/reports"><i class="fa fa-chart-line"></i> Laporan</a>
    @endrole

    <hr class="text-secondary">

    <form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="btn btn-danger w-100">
        Logout
    </button>
</form>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Dashboard</h5>

        <div>
            <strong>{{ auth()->user()->name }}</strong>
            <span class="badge bg-primary">
                {{ auth()->user()->getRoleNames()->first() }}
            </span>
        </div>
    </div>

    <!-- CONTENT -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>