@extends('admin.dashboard')

@section('content')


<style>
    .content {
        background-color: #ffffff;
        min-height: 100vh;
        padding: 20px;
    }
    .form-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        margin: 0 auto;
    }
    .form-title {
        font-size: 1.5rem;
        color: #007bff;
        margin-bottom: 20px;
    }
    .form-content {
        display: flex;
        justify-content: space-between;
    }
    .form-left, .form-right {
        width: 48%; 
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
    .checkbox-group {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }
    .checkbox-label {
        margin-bottom: 10px;
    }
    .btn-add-service {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: right;
    }
    .btn-delete-service {
        background-color: #ff4c4c;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }
    .btn-disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
    .form-buttons {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
</style>

<div class="container ">
    <h1>Edit Service</h1>
    <div class="form-container">
        <h2 class="form-title">Edit Service</h2>
        <form method="POST" onsubmit="{{ route('admin.editServiceList', ['id' => $layanans2->id]) }} ">
            @csrf
            <div class="form-content">
                <div class="form-left">
                    <div class="form-group">
                        <label for="nama_layanan">Service Name</label>
                        <input type="text" id="nama_layanan" name="nama_layanan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="durasi_layanan">Duration</label>
                        <div style="display: flex; align-items: center;">
                            <input type="number" id="durasi_layanan" name="durasi_layanan" class="form-control" style="width: 100px;" min="1" required>
                            <span style="margin-left: 10px;">Day</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_layanan">Price</label>
                        <div style="display: flex; align-items: center;">
                            <input type="number" id="harga_layanan" name="harga_layanan" class="form-control" style="width: 150px;" min="1" required>
                            <span style="margin-left: 10px;">Rupiah</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="isi_layanan">Service Detail</label>
                        <input type="text" id="isi_layanan" name="isi_layanan" class="form-control" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="deskripsi_layanan" name="deskripsi_layanan" class="form-control" rows="4" required></textarea>
                    </div> 

                    <div class="form-group">
                        <label for="keterangan_layanan">Additional info</label>
                        <textarea id="keterangan_layanan" name="keterangan_layanan" class="form-control" rows="4" required></textarea>
                    </div>
                </div>

                <div class="form-right ms-3">
                    <div class="form-group">
                        <label>Suitable for</label>
                        <p class="text-muted">select one or more category (s)</p>
                        <div class="checkbox-group">
                            <label class="checkbox-label"><input type="checkbox" name="categories[]" value="Pakaian"> Pakaian</label>
                            <label class="checkbox-label"><input type="checkbox" name="categories[]" value="Bed Cover"> Bed Cover</label>
                            <label class="checkbox-label"><input type="checkbox" name="categories[]" value="Boneka"> Boneka</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-buttons" style="margin-top: 20px;">
                
                <button type="button" class="btn-delete-service" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    Delete Service
                </button>
                    
                <button type="submit" id="saveBtn" class="btn-add-service">Save Service</button>
            </div>
        </form>
    </div>
</div>

            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        Are you sure want to delete this service?
                    </div>
                    <div class="modal-footer" style="display=flex; justify-content: center;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 30px;">Back</button>
                        <a href="{{ route('admin.deleteService', ['id' => $layanans2->id]) }}">
                            <button type="button" class="btn btn-primary" style="border-radius: 30px;">Delete</button>
                        </a>
                    </div>
                    </div>
                </div>
            </div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const saveBtn = document.getElementById('saveBtn');
        const form = document.getElementById('editServiceForm');


        function checkFormFilled() {
            const serviceName = document.getElementById('service_name').value.trim();
            const duration = document.getElementById('duration').value.trim();
            const price = document.getElementById('price').value.trim();
            const description = document.getElementById('description').value.trim();

            if (serviceName && duration && price && description) {
                saveBtn.disabled = false;
                saveBtn.classList.remove('btn-disabled');
            } else {
                saveBtn.disabled = true;
                saveBtn.classList.add('btn-disabled');
            }
        }

        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', checkFormFilled);
        });
    });
</script>

@endsection
