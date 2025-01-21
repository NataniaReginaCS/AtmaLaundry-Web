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

<div class="content bg-white">
    <div class="container">
        <h3 class="text-primary">Customer List</h3>

        <div class="card">
            <div class="card-body">

            <input type="text" id="searchId" class="form-control mb-3" placeholder="Search by Customer ID...">

                <div class="customer-list" style="max-height: 300px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer ID</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody id="customerTable">
                            @foreach($users as $index => $user)
                                <tr class="customer-row"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->nama }}" 
                                    data-email="{{ $user->email }}"
                                    data-phone="{{ $user->telepon }}"
                                    data-address="{{ $user->alamat }}">
                                    <td>
                                        <div class="nomor" style="background-color: #1678F3; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td>#C{{ $user->id }}</td>
                                    <td>{{$user->nama}}</td>
                                    <td>{{$user->tanggal_lahir}}</td>
                                    <td>{{$user->telepon}}</td>
                                    <td>{{$user->alamat}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
                <div class="mt-3">
                    <button id="deleteBtn" class="btn btn-danger" disabled>Delete User</button>
                    <button id="editBtn" class="btn btn-primary" disabled>Edit User</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User #C{{$user->id}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please enter your password to confirm the deletion:</p>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required style="border: none;">
                    <div class="input-group-text" style="border: none; background-color: white;">
                        <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Berhasil detele User</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User #C{{$user->id}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="editPhone" placeholder="Enter phone">
                </div>
                <div class="mb-3">
                    <label for="editAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="editAddress" placeholder="Enter address">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveEditBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSuccessModal" tabindex="-1" aria-labelledby="editSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSuccessModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Berhasil Edit User <span id="editedCustomerId"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let selectedRow = null;

    document.querySelectorAll('.customer-row').forEach(function (row) {
        row.addEventListener('click', function () {
            if (selectedRow) {
                selectedRow.classList.remove('table-active');
            }

            row.classList.add('table-active');
            selectedRow = row;

            document.getElementById('editBtn').disabled = false;
            document.getElementById('deleteBtn').disabled = false;
        });
    });

    document.getElementById('deleteBtn').addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const userId =selectedRow.getAttribute('data-id');
        document.getElementById('deleteModalLabel').textContent = `Delete User #C${userId}`;

        modal.show();
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (selectedRow) {
            const userId = selectedRow.getAttribute('data-id');
            const password = document.getElementById('password').value;

            if (password) {
                fetch(`/admin/users/${userId}/delete`, {
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
                        const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                        deleteModal.hide();

                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        selectedRow.remove();
                        selectedRow = null;

                        document.getElementById('deleteBtn').disabled = true;
                        document.getElementById('editBtn').disabled = true;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                });
            } else {
                alert('Please enter your password.');
            }
        }
    });

    document.getElementById('deleteBtn').disabled = true;
    document.getElementById('editBtn').disabled = true;
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let selectedRow = null;

        document.querySelectorAll('.customer-row').forEach(function(row) {
            row.addEventListener('click', function () {
                
                if (selectedRow) {
                    selectedRow.classList.remove('table-active');
                }

                row.classList.add('table-active');
                selectedRow = row;

                document.getElementById('editBtn').disabled = false;
                document.getElementById('deleteBtn').disabled = false;
            });
        });

        document.getElementById('editBtn').addEventListener('click', function () {
            const modal = new bootstrap.Modal(document.getElementById('editModal'));

            if (selectedRow) {
                const userId =selectedRow.getAttribute('data-id')
                const phone = selectedRow.getAttribute('data-phone');
                const address = selectedRow.getAttribute('data-address');

                document.getElementById('editPhone').textContent = phone;
                document.getElementById('editAddress').textContent = address;

                document.getElementById('editModalLabel').textContent = `Edit User #C${userId}`;
            }

            modal.show();
        });

        document.getElementById('saveEditBtn').addEventListener('click', function () {
            if (selectedRow) {
                const userId =selectedRow.getAttribute('data-id');
                const editedPhone = document.getElementById('editPhone').value;
                const editedAddress = document.getElementById('editAddress').value;

                fetch(`/admin/users/${userId}/edit`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ telepon: editedPhone, alamat: editedAddress }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        selectedRow.setAttribute('data-phone', editedPhone);
                        selectedRow.setAttribute('data-address', editedAddress);
                        selectedRow.children[4].textContent = editedPhone;
                        selectedRow.children[5].textContent = editedAddress;

                        const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                        modal.hide();

                        const successModal = new bootstrap.Modal(document.getElementById('editSuccessModal'));
                        successModal.show();
                    }else{
                        alert('Failed to edit user. Try again later.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the user.');
                });
            }

            document.getElementById('deleteBtn').disabled = true;
            document.getElementById('editBtn').disabled = true;
        });
    });
</script>

<script> 
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('bi-eye');
    });
</script>

<script>
    document.getElementById('searchId').addEventListener('input', function () {
        const searchId = this.value.toLowerCase();

        document.querySelectorAll('.customer-row').forEach(function (row) {
            const customerId = row.getAttribute('data-id');
            if (customerId.toLowerCase().includes(searchId)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection
