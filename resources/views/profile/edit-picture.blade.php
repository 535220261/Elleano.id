@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile Picture</h2>
    <form action="{{ route('profile-picture.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Upload New Picture (JPG/PNG, max 5MB)</label>
            <input class="form-control" type="file" name="profile_picture" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection