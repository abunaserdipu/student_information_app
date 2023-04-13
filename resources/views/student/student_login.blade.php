@extends('layouts.app')
@section('guest_content')
  <div class="row p-0 m-0 d-flex justify-content-center align-items-center flex-column">
    <div class="col-md-3">
      <img src="{{ asset('assets/images/student.jpg') }}" style="width:100%" alt="">
    </div>
    <h1 class="text-center text-info">Student Login</h1>

    <div class="col-md-9">
      {{-- Error Alert --}}
      @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ Session::get('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form action="{{ route('student.login') }}" method="post" id="form">
        @csrf
        <div class="mb-3">
          <label for="">Email</label>
          <input class="form-control" type="email" name="email" placeholder="Your Email">
        </div>
        <div class="mb-3">
          <label for="">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <input class="form-control btn btn-info py-2" type="submit" value="Login">
      </form>
      <a class="text-center" href="{{ route('login') }}">Admin Login</a>
      <p class="shadow rounded text-center mt-2">Email: hasan@gmail.com || password: password</p>
    </div>
  </div>
@endsection
