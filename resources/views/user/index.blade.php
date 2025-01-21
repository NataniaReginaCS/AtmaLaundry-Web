@extends('user.dashboard')

@section('content')

<section id="user-dashboard">

    <h1 class="title">Dashboard</h1>

    <div class="list-menu">
        <div class="menu shadow">
            <a href="{{ url('/orderList?nama_kategori=Pakaian')}}" class="nav-link">
                <i class="fa-solid fa-shirt"></i>
                <p>Pakaian</p>
            </a>
        </div>

        <div class="menu shadow">
            <a href="{{ url('/orderList?nama_kategori=Bed Cover')}}" class="nav-link">
                <i class="fa-solid fa-bed"></i>
                <p>Bed Cover</p>
            </a>
        </div>

        <div class="menu shadow">
            <a href="{{ url('/orderList?nama_kategori=Boneka')}}" class="nav-link">
                <i class="fa-brands fa-github-alt"></i>
                <p>Boneka</p>
            </a>
        </div>

        <div class="menu shadow">
            <a href="{{ url('/orderList')}}" class="nav-link">
                <i class="fa-solid fa-rectangle-list"></i>
                <p>See All</p>
            </a>
        </div>

    </div>

    <div class="recent-order">
        <h4>Recent Order</h4>
        <table class="table table-striped">
            <tbody>
                @foreach($recentOrder as $order)
                    <tr>
                        <td>
                            <div style="background-color: #007BFF; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                {{ $loop->iteration }}
                            </div>
                        </td>
                        <td>#{{ $order->id }}</td>
                        <td>Paket {{ $order->layanan->nama_layanan ?? 'Layanan Tidak Ada' }}</td>
                        <td>Rp {{ number_format($order->layanan->harga_layanan * $order->total_bobot, 0, ",", ".") }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="balance shadow">
        <div class="card">
            <div class="card-header"><p>SPENDING</p> <i class="fa-solid fa-wallet"></i></div>
            <div class="card-body">
            @if ($balance)
                <p class="money">Rp {{ number_format($balance->nominal, 0, ",", ".") }},-</p>
            @else
                <p class="text-danger">Balance tidak ditemukan</p>
            @endif
            </div>
        </div>
    </div>

    <div class="statistic shadow card">
        <div class="card">
            <div class="card-header"><p>STATISTIC</p> <i class="fa-solid fa-file-lines"></i></div>
            <div class="card-body">
                <table>
                    @foreach($statistic as $stat)
                    <tr>
                        <td style="width: 80%;">{{ $stat['name'] }}</td>
                        <td style="width: 20%; text-align: end;">{{ $stat['value'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</section>

@endsection