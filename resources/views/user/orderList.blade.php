@extends('user.dashboard')

@section('content')

<section id="order-list">

    <h1 class="title">Order List</h1>

    <div class="form-bar">
        <form action="">
            <div class="searchbar">
                <input type="text" id="search" placeholder="search order...">
                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <select name="show" id="show" onchange="location = this.value;">
                <option value="" selected>Dropdown category (see all, pakaian, boneka, bed cover)</option>
                <option value="{{ url('/orderList') }}" {{ !$nama_kategori ? 'selected' : '' }}>See All</option>
                <option value="{{ url('/orderList?nama_kategori=Pakaian') }}" {{ $nama_kategori === 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                <option value="{{ url('/orderList?nama_kategori=Boneka') }}" {{ $nama_kategori === 'Boneka' ? 'selected' : '' }}>Boneka</option>
                <option value="{{ url('/orderList?nama_kategori=Bed Cover') }}" {{ $nama_kategori === 'Bed Cover' ? 'selected' : '' }}>Bed Cover</option>
            </select>

            <a href="{{ url('orderForm') }}">
                <button type="button" id="createOrder">Create Order</button>
            </a>
        </form>
    </div>

    <div class="order-table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Order Id</td>
                    <td>Service</td>
                    <td>Category</td>
                    <td>Weight</td>
                    <td>Total</td>
                    <td id="order-date">Date</td>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>
                        <div class="nomor" style="background-color: #1678F3; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                            {{ $index + 1 }}
                        </div>
                    </td>
                    <td>{{ $order->id }}</td>
                    <td>PAKET {{ $order->layanan->nama_layanan }}</td>
                    <td>{{ $order->kategori->nama_kategori }}</td>
                    <td>{{ $order->total_bobot }} KG</td>
                    <td>Rp {{ number_format($order->layanan->harga_layanan * $order->total_bobot, 0, ",", ".") }}</td>
                    <td class="status">
                        <p style="color: #1678F3; margin-bottom: 0px;">
                            {{ date('D, d M Y', strtotime($order->tgl_order)) }}
                        </p>
                        <form action="{{ url('orderStatus/' . $order->id) }}" class="status-form" method="get">
                            <input type="hidden" name="orderId" value="{{ $order->id }}">
                            <input type="hidden" name="orderPacket" value="{{ $order->layanan->nama_layanan }}">
                            <input type="hidden" name="orderStatus" value="{{ $order->status_pesanan }}">
                            <input type="hidden" name="orderCategory" value="{{ $order->kategori->nama_kategori }}">
                            <input type="hidden" name="orderWeight" value="{{ $order->total_bobot }}">
                            <input type="hidden" name="orderPrice" value="{{ $order->layanan->harga * $order->total_bobot }}">
                            <button type="submit" class="status-btn">Status</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection