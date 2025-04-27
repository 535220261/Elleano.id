<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag untuk pengaturan tampilan dan karakter -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Judul halaman -->
    <title>Login Account | Elleano Fashion Wears</title>
    <!-- Favicon (ikon tab browser) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">
    <!-- Font dan ikon Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Stylesheet kustom -->
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <link href="{{ asset('login.css') }}" rel="stylesheet">
    <!-- Include Bootstrap CSS untuk modal -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('layouts.navbar')

<div class="main-content">
    <div class="login-container">
        <!-- Form login -->
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h1>Login</h1>
            <input placeholder="Name" name="name" type="text" required>
            <br>
            <input placeholder="Password" name="password" type="password" required>
            <br>
            <button type="submit" class="sub">Login</button>
            <h6>Don't have an account?</h6>
            <a href="{{ route('register') }}">Create a new account</a>
        </form>
    </div>
</div>

@include('layouts.footer')

<!-- Modal untuk pesan kesalahan saat login -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Judul modal -->
                <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Bagian tubuh modal untuk menampilkan pesan kesalahan -->
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <!-- Tombol untuk menutup modal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.alert-message')) {
        alert(document.querySelector('.alert-message').innerText);
    }
});
</script>
<!-- Include jQuery dan Bootstrap JS untuk modal -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@if (session('error'))
    <!-- Script untuk menampilkan modal jika terdapat pesan kesalahan -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#errorModal').modal('show');
        });
    </script>
@endif
</body>
</html>
