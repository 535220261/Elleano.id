{{-- signup.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Account | Elleano Fashion Wears</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/elleano.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <link href="{{ asset('login.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navbar')

<!-- Form Register -->
<div class="main-content">
    <div class="login-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1>Signup</h1>
            <input placeholder="Name" name="name" type="text" required>
            <br>
            <input placeholder="Password" name="password" type="password" required>
            <br>
            <input placeholder="Confirm Password" name="password_confirmation" type="password" required>
            <br>
            <button type="submit" class="sub">Sign Up</button>
            <h6>Already have an account?</h6>
            <a href="{{ route('login') }}">Login</a>
        </form>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.alert-message')) {
        alert(document.querySelector('.alert-message').innerText);
    }
});
</script>

<!-- Displaying Session Messages -->
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            alert("{{ $error }}");
        @endforeach
    </script>
@endif

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('login') }}";
    </script>
@endif

</body>
</html>
