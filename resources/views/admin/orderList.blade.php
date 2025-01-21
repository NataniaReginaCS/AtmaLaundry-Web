@extends('admin.dashboard')

@section('content')

<style>
    .number-box {
        width: 30px;
        height: 30px;
        background-color: #007bff;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    .table-active {
        background-color: #f0f8ff !important;
    }
</style>

<section id="order-list">
<div class="content bg-white">
    <div class="container">
        <h3 class="text-primary">Order List</h3>

        <div class="card">
            <div class="card-body">

                <div class="d-flex mb-3">
                <input type="text" id="search" class="form-control me-3" placeholder="Search order by ID..." value="{{ request()->input('searchId') }}">
                    
                    <select class="form-select" id="categoryFilter" onchange="location = this.value;">
                        <option value="{{ url('/adminOrderList') }}" {{!$nama_kategori ? 'selected' : '' }}>See All</option>
                        <option value="{{ url('/adminOrderList?nama_kategori=Pakaian') }}" {{ $nama_kategori === 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                        <option value="{{ url('/adminOrderList?nama_kategori=Boneka') }}" {{ $nama_kategori === 'Boneka' ? 'selected' : '' }}>Boneka</option>
                        <option value="{{ url('/adminOrderList?nama_kategori=Bed Cover') }}" {{ $nama_kategori === 'Bed Cover' ? 'selected' : '' }}>Bed Cover</option>
                    </select>
                </div>

                <div class="order-list" style="max-height: 300px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Finish Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderTable">
                        @foreach($orders as $index => $order)
                        <tr class="order-row" 
                            data-id="{{ $order->id }}"
                            data-name="{{ $order->user->nama }}" 
                            data-phone="{{ $order->user->telepon }}" 
                            data-category="{{ $order->kategori->nama_kategori }}" 
                            data-service="{{ $order->layanan->nama_layanan }}" 
                            data-weight="{{ $order->total_bobot }}" 
                            data-address="{{ $order->user->alamat }}" 
                            data-request="{{ $order->request }}">
                            <td><div class="number-box">{{ $index + 1 }}</div></td>
                            <td>#{{ $order->id }}</td>
                            <td>{{ date('d-m-Y', strtotime($order->tgl_order)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($order->tgl_selesai)) }}</td>
                            <td>Rp {{ number_format($order->layanan->harga_layanan * $order->total_bobot, 0, ",", ".") }}</td>
                            <td class="status-column">{{ ucfirst($order->status_pesanan) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button id="deleteOrderBtn" class="btn btn-danger" disabled>Delete Order</button>
                    <button id="editOrderBtn" class="btn btn-primary" disabled>Edit Order</button>
                    <button id="viewOrderBtn" class="btn btn-info" disabled>View Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-start">
                <h5 class="text-primary text-center mb-3"><p><strong>View Order  (<span id="viewOrderId"></span>)</strong></p></h5>
                <div>
                    <p><strong>Nama:</strong> <span id="viewOrderName"></span></p>
                    <p><strong>Nomor Telepon:</strong> <span id="viewOrderPhone"></span></p>
                    <p><strong>Kategori:</strong> <span id="viewOrderCategory"></span></p>
                    <p><strong>Service:</strong> <span id="viewOrderService"></span></p>
                    <p><strong>Weight:</strong> <span id="viewOrderWeight"></span></p>
                    <p><strong>Address:</strong> <span id="viewOrderAddress"></span></p>
                    <p><strong>Request:</strong> <span id="viewOrderRequest"></span></p>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Edit Order -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-start">
                <h5 class="text-primary text-center mb-3"><p><strong>Edit Order </strong> <span id="editOrderId"></span></p></h5>
                <div>
                    <p><strong>Nama:</strong> <span id="editOrderName"></span></p>
                    <p><strong>Nomor Telepon:</strong> <span id="editOrderPhone"></span></p>
                    <p><strong>Kategori:</strong> <span id="editOrderCategory"></span></p>
                    <p><strong>Service:</strong> <span id="editOrderService"></span></p>
                    <p><strong>Weight:</strong> <span id="editOrderWeight"></span></p>
                    <p><strong>Address:</strong> <span id="editOrderAddress"></span></p>
                    <p><strong>Request:</strong> <span id="editOrderRequest"></span></p>

                    <div class="mb-3">
                        <label for="editOrderStatus" class="form-label"><strong>Status:</strong></label>
                        <select id="editOrderStatus" class="form-select">
                            <option value="on_delivery">On Delivery</option>
                            <option value="pickup">Pickup</option>
                            <option value="folding">Folding</option>
                            <option value="ironing">Ironing</option>
                            <option value="dry_wash">Dry & Wash</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-primary px-4" id="saveOrderStatusBtn" data-bs-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses Edit-->
<div class="modal fade" id="successUpdateModal" tabindex="-1" aria-labelledby="successUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 400px;">
            <div class="modal-body text-center">
                <h5 class="text-secondary">Berhasil Edit Order</h5>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Order -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-start">
                <h5 class="text-primary text-center mb-3"><strong>Konfirmasi Hapus Order</strong></h5>
                <div>
                    <div class="mb-3">
                        <label for="deletePassword" class="form-label"><strong>Password:</strong></label>
                        <input type="password" id="deletePassword" class="form-control" placeholder="Masukkan password Anda">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses Hapus Order -->
<div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 400px;">
            <div class="modal-body text-center">
                <h5 class="text-secondary">Berhasil Menghapus Order</h5>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteOrderBtn = document.getElementById('deleteOrderBtn');
    const editOrderBtn = document.getElementById('editOrderBtn');
    const viewOrderBtn = document.getElementById('viewOrderBtn');
    let selectedRow = null;

    document.querySelectorAll('.order-row').forEach(row => {
        row.addEventListener('click', function () {
            if (selectedRow) {
                selectedRow.classList.remove('table-active');
            }

            selectedRow = this;
            selectedRow.classList.add('table-active');

            deleteOrderBtn.disabled = false;
            editOrderBtn.disabled = false;
            viewOrderBtn.disabled = false;
        });
    });

    deleteOrderBtn.addEventListener('click', function () {
        if (selectedRow) {
            const orderId = selectedRow.getAttribute('data-id');

            const modal = new bootstrap.Modal(document.getElementById('deleteOrderModal'));
            modal.show();

            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                const password = document.getElementById('deletePassword').value;

                if (password) {
                    fetch(`/admin/orders/${orderId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ password: password }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteOrderModal'));
                            deleteModal.hide();

                            const successModal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                            successModal.show();

                            selectedRow.remove();
                            selectedRow = null;
                            deleteOrderBtn.disabled = true;
                            editOrderBtn.disabled = true;
                            viewOrderBtn.disabled = true;
                        } else {
                            alert(data.message); 
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // alert('An error occurred while deleting the order.');
                    });
                } else {
                    alert('Password harus diisi.');
                }
            });
        }
    });

    viewOrderBtn.addEventListener('click', function () {
        if (selectedRow) {
            document.getElementById('viewOrderId').textContent = selectedRow.getAttribute('data-id');
            document.getElementById('viewOrderName').textContent = selectedRow.getAttribute('data-name');
            document.getElementById('viewOrderPhone').textContent = selectedRow.getAttribute('data-phone');
            document.getElementById('viewOrderCategory').textContent = selectedRow.getAttribute('data-category');
            document.getElementById('viewOrderService').textContent = selectedRow.getAttribute('data-service');
            document.getElementById('viewOrderWeight').textContent = selectedRow.getAttribute('data-weight');
            document.getElementById('viewOrderAddress').textContent = selectedRow.getAttribute('data-address');
            document.getElementById('viewOrderRequest').textContent = selectedRow.getAttribute('data-request');
            
            const modal = new bootstrap.Modal(document.getElementById('viewOrderModal'));
            modal.show();
        }
    });

    editOrderBtn.addEventListener('click', function () {
        if (selectedRow) {
            const orderId = selectedRow.getAttribute('data-id');
            const orderName = selectedRow.getAttribute('data-name');
            const orderPhone = selectedRow.getAttribute('data-phone');
            const orderCategory = selectedRow.getAttribute('data-category');
            const orderService = selectedRow.getAttribute('data-service');
            const orderWeight = selectedRow.getAttribute('data-weight');
            const orderAddress = selectedRow.getAttribute('data-address');
            const orderRequest = selectedRow.getAttribute('data-request');
            const currentStatus = selectedRow.getAttribute('data-status'); 

            document.getElementById('editOrderId').textContent = orderId;
            document.getElementById('editOrderName').textContent = orderName;
            document.getElementById('editOrderPhone').textContent = orderPhone;
            document.getElementById('editOrderCategory').textContent = orderCategory;
            document.getElementById('editOrderService').textContent = orderService;
            document.getElementById('editOrderWeight').textContent = orderWeight;
            document.getElementById('editOrderAddress').textContent = orderAddress;
            document.getElementById('editOrderRequest').textContent = orderRequest;

            document.getElementById('editOrderStatus').value = currentStatus;

            const modal = new bootstrap.Modal(document.getElementById('editOrderModal'));
            modal.show();
        }
    });

document.getElementById('saveOrderStatusBtn').addEventListener('click', function () {
    if (selectedRow) {
        const orderId = selectedRow.getAttribute('data-id');
        const newStatus = document.getElementById('editOrderStatus').value;

        fetch(`/admin/orders/${orderId}/update-status`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: newStatus }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                selectedRow.setAttribute('data-status', newStatus);
                selectedRow.querySelector('.status-column').textContent = newStatus;

                const modal = bootstrap.Modal.getInstance(document.getElementById('editOrderModal'));
                modal.hide();

                const successModal = new bootstrap.Modal(document.getElementById('successUpdateModal'));
                successModal.show();
            } else {
                alert('Failed to update order status. Try again later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the order status.');
        });
    }
});


    document.getElementById('search').addEventListener('keyup', function() {
        const searchQuery = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('.order-row');
        
        rows.forEach(row => {
            const orderId = row.getAttribute('data-id');
            if (orderId.toLowerCase().includes(searchQuery)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

</script>

</section>
@endsection
