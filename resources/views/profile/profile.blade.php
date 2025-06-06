<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Your Profile | Elleano</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">
    
    @include('layouts.navbar_account')
<hr class="mt-0 mb-4">
<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card -->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Gambar dengan preview modal -->
                <div style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 2px solid #ccc; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imagePreviewModal">
                    <img
                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/avatar.png') }}"
                        alt="Profile Picture"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <!-- Modal Preview -->
                <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-center">
                            <div class="modal-header">
                                <h5 class="modal-title">Profile Picture</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <img
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/avatar.png') }}"
                                    alt="Profile Picture"
                                    style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="modal-footer justify-content-center">
                                <form action="{{ route('profile-picture.edit') }}" method="GET" class="d-inline">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                                <form action="{{ route('profile-picture.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this picture?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('profile-picture.create') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <input class="form-control mb-2" type="file" name="profile_picture" accept=".jpg,.jpeg,.png" required>
                    @error('profile_picture')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-primary" type="submit">Change Profile Picture</button>
                </form>

                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <hr>

<div class="mt-3">
    <form id="logout-form-profile" action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-danger w-100" type="submit" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">
            Logout
        </button>
    </form>
</div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <!-- Account details card -->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Username</label>
                        <input class="form-control readonly-field" id="inputUsername" name="username" type="text" value="{{ Auth::user()->username }}">
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">First Name</label>
                            <input class="form-control readonly-field" id="inputFirstName" name="first_name" type="text" value="{{ Auth::user()->first_name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Last Name</label>
                            <input class="form-control readonly-field" id="inputLastName" name="last_name" type="text" value="{{ Auth::user()->last_name }}">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="small mb-1" for="inputLocation">Location</label>
                        <input class="form-control readonly-field" id="inputLocation" name="location" type="text" value="{{ Auth::user()->location }}">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control readonly-field" id="inputEmailAddress" name="email" type="email" value="{{ Auth::user()->email }}">
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Phone Number</label>
                            <input class="form-control readonly-field" id="inputPhone" name="phone" type="tel" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                            <input class="form-control readonly-field" id="inputBirthday" name="birthday" type="date" value="{{ Auth::user()->birthday }}">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <button type="button" class="btn btn-secondary me-2" id="editBtn">Edit</button>
                    <button class="btn btn-primary" type="submit" id="saveBtn" disabled>Save changes</button>
                </form>


            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
<!-- JavaScript for toggle readonly -->
<script>
    document.getElementById('editBtn').addEventListener('click', function () {
        const fields = document.querySelectorAll('.readonly-field');
        fields.forEach(field => {
            field.removeAttribute('readonly');
            field.style.backgroundColor = "#fff";
        });
        document.getElementById('saveBtn').disabled = false;
    });

    // Initial styling for readonly fields
    document.querySelectorAll('.readonly-field').forEach(field => {
        field.setAttribute('readonly', true);
        field.style.backgroundColor = "#e9ecef"; // light gray transparent
    });
</script>

                <script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const fields = document.querySelectorAll('.readonly-field');

    let originalValues = {};

    function setReadonly(state) {
        fields.forEach(field => {
            if (state) {
                field.setAttribute('readonly', true);
                field.style.backgroundColor = "#e9ecef";
            } else {
                field.removeAttribute('readonly');
                field.style.backgroundColor = "#fff";
            }
        });
        saveBtn.disabled = state;
    }

    function storeOriginalValues() {
        fields.forEach(field => {
            originalValues[field.id] = field.value;
        });
    }

    function restoreOriginalValues() {
        fields.forEach(field => {
            if (originalValues[field.id] !== undefined) {
                field.value = originalValues[field.id];
            }
        });
    }

    // Initial setup
    setReadonly(true);
    storeOriginalValues();

    editBtn.addEventListener('click', function () {
        if (editBtn.textContent === 'Edit') {
            editBtn.textContent = 'Cancel';
            setReadonly(false);
            saveBtn.disabled = false;
        } else {
            editBtn.textContent = 'Edit';
            restoreOriginalValues();
            setReadonly(true);
        }
    });
</script>