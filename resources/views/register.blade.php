@extends('layout')
@section('content')

{{-- content --}}

<h2 class="text-center">Register</h2>
<div class="admin-register">
    <form method="POST" action="{{ Route('admin.register') }}">
        @csrf
        <div class="form-control">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control shadow-none" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control shadow-none" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control shadow-none" id="password" placeholder="Enter password" name="password" value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control shadow-none" id="password_confirmation" placeholder="Re-enter password" name="password_confirmation">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="mt-4 w-100 p-2 border-0 text-light">Register</button>
    </form>
</div>
<div class="text-center mt-2">
    <small>Already have an account? <a href="{{ Route('login') }}" class="text-dark text-decoration-none ">Login now.</a></small>
</div>


@endsection