@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="label">Post Body: </label>
                                <input class="form-control" type="textarea" name="body" id="body"
                                    autocomplete="body" value="{{ $post->body }}">
                            </div>
                            <img src="{{ url($post->media_url) }}" alt="" style="max-width: 30%">
                            <div class="form-group">
                                <label class="label">Pilih File: </label>
                                <input name="media_url" type="file" class="form-control" id="media_url"
                                    accept=".jpg,.png" autocomplete="media_url" value="{{ $post->media_url }}">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Are you sure want to submit this data ?')">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
