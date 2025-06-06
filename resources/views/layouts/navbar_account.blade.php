<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<!-- Core theme CSS (includes Bootstrap) -->
<link href="{{ asset('styles.css') }}" rel="stylesheet">

@include('layouts.navbar')
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
<nav class="nav nav-borders">
    <a class="nav-link active ms-0" href="{{ route('profile') }}">Profile</a>
    <a class="nav-link active" href="{{ route('payment_transaction') }}">Payment & Transaction</a>
    <a class="nav-link" href="{{ route('security') }}">Security</a>
    <a class="nav-link" href="{{ route('notifications') }}">Notifications</a>
</nav>
