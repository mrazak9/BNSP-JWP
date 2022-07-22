@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="label">Post Body: </label>
                            <textarea name="body" rows="4" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="label">Pilih File: </label>
                            <input  name="media_url" type="file" class="form-control" id="media_url" accept=".jpg,.png" />
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
