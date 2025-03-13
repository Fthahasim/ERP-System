@extends('layout')
@section('content')

{{-- content --}}

<h2 class="text-center">Login</h2>
<div class="admin-login">
    <form action="{{ Route('admin.login') }}">
        @csrf
        <div class="form-control">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control shadow-none" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control shadow-none" id="password" placeholder="Enter password" name="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="mt-4 w-100 p-2 border-0 text-light">Login</button>
    </form>
</div>
<div class="text-center mt-2">
    <small>Don't have an account? <a href="{{ Route('register') }}" class="text-dark text-decoration-none ">Register now.</a></small>
</div>


@endsection