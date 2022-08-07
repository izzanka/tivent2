@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-person"></i> <b>Profile</b>
                </div>
                <div class="card-body">
                    <form action="user/profile-information" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control @error('name') is-invalid @enderror">
                            
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control @error('email') is-invalid @enderror">
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <button type="submit" class="btn-sm btn btn-primary float-right"> Update Profile</button>
                    </form>
                </div>         
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-person"></i> <b>Password</b>
                </div>

                <div class="card-body">
                    <form action="user/password" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    
                        <button type="submit" class="btn-sm btn btn-primary float-right"> Update Password</button>
                    </form>
                </div>         
            </div>
        </div>
    </div>
</div>
@endsection