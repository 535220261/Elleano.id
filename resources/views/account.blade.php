<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">My Account</h2>
        <p class="fs-5">Welcome, <strong>{{ session('user_name') }}</strong>!</p>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary me-2">Go to Home</a>

            <a href="{{ route('logout') }}" class="btn btn-outline-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>