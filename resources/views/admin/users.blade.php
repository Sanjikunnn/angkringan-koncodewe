@extends('admin.app')

@section('title', 'Pelanggan Koncodewe - Admin')

@section('user')
Admin {{ $data['user']->name }}
@endsection

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Halaman Untuk Kelola Pelanggan</li>
        </ol>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h4><i class="fas fa-table mr-1"></i>Data Pelanggan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tgl Join</th>
                                <th>Nama</th>
                                <th>WhatsApp</th>
                                <th>Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tgl Join</th>
                                <th>Nama</th>
                                <th>WhatsApp</th>
                                <th>Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data['users'] as $user)
                            <tr>
                                @php ($create = date("d M Y ", strtotime($user->created_at)))
                                <td>{{ $create }}</td>
                                <td>{{ $user->name }}<br>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @foreach ($user->order as $order)
                                    @if ($order->status != null)
                                    Status: <b>{{ $order->status }}</b><br>
                                    @foreach ($order->cart as $cart)
                                    {{ $cart->amount }} {{ $cart->product->name }}<br>
                                    @endforeach
                                    <hr>
                                    @endif
                                    @endforeach
                                </td>
                                <th class="text-center">
                                    @php ($phone = $user->phone)
                                    <a target="_blank" href="https://wa.me/{{ $phone }}?text=Halo%20Kak%20{{ $user->name }}%20...%0AKami%20dari%20Admin%20De%20Tasty" type="submit" class="btn btn-secondary btn-sm">chat</a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection