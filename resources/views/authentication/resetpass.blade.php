@extends('head')
@section('content')
<div class="mx-auto text-white card-login bg-white">
        <h3 class="text-center sign-in mb-3">Reset Password</h3>
        <div class="d-flex justify-content-center mb-2">
            <img src="image/logo_vioscake.png" alt="logo vioscake" class="img-fluid">
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
            </div>
            @endif
            @if(session()->has('status'))
            I
            <div class="alert alert-success">
            {{ session()->get('status') }}
            </div>
            @endif

        <!-- {{route('login.action')}} -->
        <form method="post" action="{{route('resetpass.action')}}" class="px-5 py-1">
        @csrf
            <input type="hidden" name="token" value="{{request()->token}}">
            <input type="hidden" name="email" value="{{request()->email}}">
            <div class="mb-3">
                <!-- <input type="text" class="form-control" name="username" placeholder=" Username" required> -->
                <input type="text" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <!-- <input type="password" class="form-control"  name="password" placeholder="Password" required>   -->
                <input type="text" class="form-control" name="password_confirmation"  placeholder="Confirmation Password" required>     
            </div> 
            <div class="mb-2 btn-login">
               <!-- <a href="" class="btn w-100 teks-login" type="submit">Login</a> -->
               <button type="submit" class="btn w-100 teks-login">Reset</button>
            </div>

        </form>
    </div>



@endsection
