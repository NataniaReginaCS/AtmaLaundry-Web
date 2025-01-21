@extends('user.dashboard')

@section('content')

<section id="order-form">

    <h1 class="title">New Order</h1>

    <div class="form-container">
        <h4 class='form-title'>Create Order</h4>
        <form action="{{ route('pesanan.store') }}" id="orderForm" method="POST">
            @csrf
        <div class="customer-name question">
            <label for="customerName">Customer Name</label> <br>
            <input type="text" id="customerName" name="customerName" required>
        </div>
        <div class="phone-number question">
            <label for="phoneNumber">Phone Number</label> <br>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
        </div>
        <div class="category question">
            <label for="id_kategori">Category</label> <br>
            <select id="id_kategori" name="id_kategori" required>
                <option value="" selected>Select Category</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="service question">
            <label for="id_layanan">Service</label> <br>
            <select id="id_layanan" name="id_layanan" required>
                <option value="" selected>Select Service</option>
                @foreach ($layanans as $layanan)
                    <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                @endforeach
            </select>
        </div>
        <div class="weight question">
            <label for="total_bobot">Weight</label> <br>
            <input type="number" id="total_bobot" name="total_bobot" required>
        </div>
        <div class="request question">
            <label for="request">Request</label> <br>
            <textarea name="request" id="request" rows='3'></textarea>
        </div>
        <div class="address question">
                <label for="address">Delivery Address</label> <br>
                <textarea name="address" id="address" rows='6' placeholder="Please write down your complete address and kindly wait for your laundry to be delivered to your doorstep!" required></textarea>
            </div>
        <div class="button">
            <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i> Add to Cart</button>
        </div>
    </form>
    </div>

</section>

@endsection