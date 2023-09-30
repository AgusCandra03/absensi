@extends('layouts.dashboard')
@section('header', 'Edit Profile')

@section('content')
<div id="controller">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{route('update-profile')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="text" class="form-control" id ="email" name="email" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id ="password" name="password" placeholder="*******">
                    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Retype Password</strong></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="*******">
                        
                    </div>
                    <button class="btn btn-primary" type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection