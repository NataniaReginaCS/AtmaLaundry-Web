@php
    use Carbon\Carbon;
@endphp

@extends('user.dashboard')

@section('content')

<section id="order-status">

    <h1 class="title">Service List</h1> 

    <div class="status-bar">
        <h2>Order ID {{ $pesanan->id }}</h2>
        <h2>Current status: {{ $pesanan->status_pesanan }}</h2>
    </div>

    <div class="status-card-list">
        
        <div class="status-card-container">
            <div class="status-card">
                <h4 class="status-title"><i class="fa-solid fa-shirt"></i> PAKET {{ $pesanan->layanan->nama_layanan }}</h4>
                <p style="font-size: large;">What’s included?</p>

                <div style="margin: 10px 0px">
                    <p><i class="fa-solid fa-circle-check"></i> {{ $services[0] ?? 'Tidak Tersedia' }}</p>
                    <p><i class="fa-solid fa-circle-check"></i> {{ $services[1] ?? 'Tidak Tersedia' }}</p>
                    @if(($_GET['orderPacket'] ?? '') == 'B' || ($_GET['orderPacket'] ?? '') == 'C')
                    <p><i class="fa-solid fa-circle-check"></i> {{ $services[2] ?? 'Tidak Tersedia' }}</p>
                    @else
                    <p><i class="fa-solid fa-circle-xmark"></i> {{ $services[2] ?? 'Tidak Tersedia' }}</p>
                    @endif
                </div>

                <p>Durasi: {{ $pesanan->durasi ?? 'Tidak Tersedia' }} hari</p>

                <strong>
                    <p>Tersisa: 
                        @if($pesanan->remainingDays >= 0)
                            {{ $pesanan->remainingDays }} hari
                        @else
                            Sudah lewat {{ abs($pesanan->remainingDays) }} hari
                        @endif
                    </p>
                </strong>

            </div>
            <p style="color: #1678F3; font-size: small;">*Waktu tertera merupakan estimasi</p>
        </div>

        <div class="status-card-container">
            <div class="status-card">
                <h4 class="status-title">Detail order</h4>

                <p style="font-size: small;">[ORDER {{ $_GET['orderId'] ?? 'Tidak Diketahui' }}]</p>

                <div>
                    <p>Kategori: {{ $_GET['orderCategory'] ?? 'Tidak Diketahui' }}</p>
                    <p>Berat: {{ $_GET['orderWeight'] ?? 'Tidak Diketahui' }} kg</p>
                    <p>Biaya: Rp {{ number_format($pesanan->layanan->harga_layanan * $pesanan->total_bobot, 0, ",", ".") }}</p>
                    <strong>
                        <p>Request: {{ $pesanan->layanan->nama_layanan ?? 'Tidak Ada Permintaan' }}</p>
                    </strong>
                </div>
            </div>
            <p style="color: #1678F3; font-size: small;">Congratulations! You've successfully earned 2 points!</p>
        </div>

    </div>

    <div class="btn-bar">
        <a href="{{ url('orderList') }}">
            <button type="button" class="back-btn">Back</button>
        </a>
    </div>

</section>

@endsection
