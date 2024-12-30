@extends('admin.app')

@section('title', 'Pesanan Koncodewe - Admin')

@section('user')
Admin {{ $data['user']->name }}
@endsection

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Halaman Untuk Kelola Pesanan</li>
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
                <h4><i class="fas fa-table mr-1"></i>Pesanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Pelanggan</th>
                                <th>Pesanan</th>
                                <th>Status</th>
                                <th>Ubah Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Pelanggan</th>
                                <th>Pesanan</th>
                                <th>Status</th>
                                <th>Ubah Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data['orders'] as $order)
                            @php ($order->all_cart = '')
                            <tr>
                                <td>{{ $order->key_id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>
                                    @foreach ($order->cart as $cart)
                                    {{$cart->amount}} {{$cart->product->name}}<br>
                                    @php ($order->all_cart =+ $cart->amount.' '.$cart->product->name.', ')
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if ($order->status == 'selesai')
                                    <button disabled class="btn btn-success btn-sm">{{ $order->status }}</button>
                                    @else
                                    <button disabled class="btn btn-info btn-sm">{{ $order->status }}</button>
                                    @endif
                                </td>
                                <td class="text-left">

                                    @php ($phone = $order->user->phone)
                                    @if ($order->status == 'proses')
                                    <form action="{{ route('status.admin', ['id' => $order->id, 'status' => 'siap']) }}" method="POST">
                                        @csrf
                                        <a target="_blank" href="https://wa.me/{{ $phone }}?text=Halo%20Kak%20{{ $order->user->name }}...%0AKami%20dari%20Angkringan%20Koncodewe%0APesanan%20Anda%20{{ $order->all_cart }}%20sedang%20kami%20proses%0AHarap%20tunggu%20sebentar%20yaaaaa%0ATerimakasih" class="btn btn-secondary btn-sm">chat</a>
                                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengubah status pesanan {{ $order->key_id }} menjadi siap?')">siap</button>
                                    </form>
                                    @elseif ($order->status == 'siap')
                                    <form action="{{ route('status.admin', ['id' => $order->id, 'status' => 'selesai']) }}" method="POST">
                                        @csrf
                                        <a target="_blank" href="https://wa.me/{{ $phone }}?text=Halo%20Kak%20{{ $order->user->name }}...%0AKami%20dari%20Angkringan%20Koncodewe%0APesanan%20Anda%20{{ $order->all_cart }}telah%20siap%20dan%20dapat%20diambil%20di%20kasir%20terimakasih" class="btn btn-secondary btn-sm">chat</a>
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengubah status pesanan {{ $order->key_id }} menjadi selesai?')">diambil & selesai</button>
                                    </form>
                                    @else
                                    <a target="_blank" href="https://wa.me/{{ $phone }}?text=Halo%20{{ $order->user->name }}...%0AKami%20dari%20Angkringan%20Koncodewe%0APesanan%20Anda%20pada%20tanggal%20{{ $order->for_date }}%20berupa%20{{ $order->all_cart }}telah%20diambil%20oleh..." class="btn btn-secondary btn-sm">chat</a>
                                    @endif
                                </td>
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
