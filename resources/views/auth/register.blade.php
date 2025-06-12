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

            <input type="text" name="name" placeholder="Name" required>
            <br>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <br>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
            <br>

        <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="showPasswordCheck">
        <label for="showPasswordCheck">Show Password</label>
        </div>
            <button type="submit" class="sub">Sign Up</button>
<br>
            <h6>Already have an account?</h6>
            <a href="{{ route('login') }}">Login</a>
        </form>
<script>
    document.getElementById('showPasswordCheck').addEventListener('change', function () {
        const passwordFields = ['password', 'password_confirmation'];
        passwordFields.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.type = this.checked ? 'text' : 'password';
            }
        });
    });
</script>
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
