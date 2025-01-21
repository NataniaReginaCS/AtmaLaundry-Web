@extends('admin.dashboard')

@section('content')

<style>
    .service-card {
        background-color: #D0F6FF; 
        border-radius: 10px;
        padding: ;
        margin: auto;
        text-align: center;
        position: relative;
        margin-bottom: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;Z
    }

    .service-card img {
        height: 120px;
        object-fit: contain;
        padding: 10px 0px;
    }

    .edit-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #999;
    }

    .price {
        background-color: white;
        border-radius: 15px;
        padding: 3px 10px;
        display: inline-block;
        margin-top: 10px;
        font-size: 0.9em;
    }

    .add-service {
        background-color: #f0f0f0;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #999;
        height: 100%;
        cursor: pointer;
    }

    .add-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .save-button {
        background-color: #e0e0e0;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        margin-top: 20px;
        float: right;
        cursor: pointer;
    }

@media (min-width: 300px) {
    .service-card {
        width: 100%;
    }
}

@media (max-width: 1000px) {
    .service-card {
        padding: 10px;
        width: 100%;
        
    }

    .service-card img {
        width: 100%;
    }

    .price {
        font-size: 0.7em;
    }

    .add-service {
        padding: 10px;
    }

    .add-icon {
        font-size: 28px;
    }
}

</style>

<section id="service-list">
    <div class="content bg-white">
        <div class="container">
            <h3 class="text-primary">Edit Services</h3>
            <div class="row mt-5">
                @foreach($layanans as $index => $s)
                <div class="col-md-4 mb-4">
                    <div class="service-card" style="">

                    <div class="front"style="background-color: #D0F6FF;">
                            
                            <a href="{{ route('admin.showEditServiceList', ['id' => $s->id]) }}">

                                <span class="edit-icon"><i class="fas fa-edit"></i></span>
                            </a>

                            @if(($index+1)%3 == 1) 
                                <img src="images/service1.svg" alt="service image">
                            @elseif(($index+1)%3 == 2)
                                <img src="images/service2.svg" alt="service image">
                            @elseif(($index+1)%3 == 0)
                                <img src="images/service3.svg" alt="service image">
                            @endif

                            <p class="name">Paket {{ $s->nama_layanan }}</p>
                            <p class="desc">{{ $s->isi_layanan }}</p>
                            <p class="price">{{  $s->harga_layanan }}/kg</p>
                        </div>
                        <div class="back">
                            <a href="{{ route('admin.showEditServiceList', ['id' => $s->id])  }}">
                                <span class="edit-icon"><i class="fas fa-edit"></i></span>
                            </a>
                            <p class="name">Paket {{  $s->nama_layanan }}</p>
                            <p class="desc">{{  $s->deskripsi_layanan }}</p>
                            <div class="additional">
                                <p class="desc">Durasi pengerjaan : {{  $s->durasi_layanan }} hari</p>
                                <p class="information">{{  $s->keterangan_layanan }}</p>
                            </div>
                            <p class="price">{{  $s->harga_layanan }}/kg</p>
                        </div>
                            
                    </div>
                </div>
                @endforeach
                <div class="col-md-4 mb-4">
                    <a href="{{ url('/newServiceList') }}" class="add-service">
                        <span class="add-icon"><i class="fa-solid fa-plus"></i></span>
                        <p>Add service</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection