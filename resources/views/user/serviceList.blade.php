@extends('user.dashboard')

@section('content')

<section id="service-list">

    <h1 class="title">Service List</h1> 

    <div class="service-card-list">

        @foreach($layanans as $index => $layanan)
        <div class="service-card mb-3">
            <div class="front">
                
                @if(($index+1)%3 == 1) 
                    <img src="images/service1.svg" alt="service image">
                @elseif(($index+1)%3 == 2)
                    <img src="images/service2.svg" alt="service image">
                @elseif(($index+1)%3 == 0)
                    <img src="images/service3.svg" alt="service image">
                @endif

                <p class="name">Paket {{ $layanan->nama_layanan }}</p>
                <p class="desc">{{ $layanan->isi_layanan }}</p>
                <p class="price">{{ $layanan->harga_layanan }}/kg</p>
            </div>

            <div class="back">
                <p class="name">Paket {{ $layanan->nama_layanan }}</p>
                <p class="desc"> {{ $layanan->deskripsi_layanan }}</p>
                <div class="additional">
                    <p class="desc">Durasi pengerjaan : {{ $layanan->durasi_layanan }} hari</p>
                    <p class="information">{{ $layanan->keterangan_layanan }}</p>
                </div>
                <p class="price">{{ $layanan->harga_layanan }}/kg</p>
            </div>
        </div>
        @endforeach

    </div>

    <p class="information">
        <i class="fa-solid fa-circle-chevron-right" style="color: #1C98ED"></i>
        For every 1kg of laundry ordered, you will earn 1 point that can be used during your transaction for a discount of IDR 1,000!
    </p>

</section>

@endsection