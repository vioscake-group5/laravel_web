@extends('head')

@section('content')
<div class="mx-auto text-white card-login bg-white">
    <h3 class="text-center sign-in mb-3">Sign In</h3>
    <div class="d-flex justify-content-center mb-1">
        <img src="image/logo_vioscake.png" alt="logo vioscake" class="img-fluid">
    </div>

    @if(session('success'))
    <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger">{{ $err }}</p>
    @endforeach
    @endif

    <form action="{{ route('login.post') }}" method="post" class="px-5 py-1">
        @csrf
        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="mb-3 text-end lupa-password">
            <a href="{{ route('forgetpass') }}" class="text-decoration-none">Lupa password?</a>
        </div>
        <div class="mb-2 btn-login">
            <button type="submit" class="btn w-100 teks-login">Login</button>
        </div>
        {{-- <div class="mb-3 btn-login-google">
            <a href="" class="btn w-100 teks-login-google">Login with Google</a>
        </div> --}}
    </form>
</div>
@endsection