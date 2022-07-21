@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-primary">My Profile</h3>
                    <hr />
                    <p> <strong>Nama:</strong> {{ $profile->name }}</p>
                    <p> <strong>Email:</strong> {{ $profile->email }}</p>
                    <p> <strong>Email:</strong> {{ $profile->avatar }}</p>
                    <img  class="rounded-circle" src="{{ url($profile->avatar) }}" alt="">
                    {{-- {{url('/images/myimage.jpg')}} --}}

                    <hr />
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary btn-block">Edit Profile</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
