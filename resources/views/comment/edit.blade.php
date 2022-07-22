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
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="label">Post Body: </label>
                                <input class="form-control" type="textarea" name="body" id="body"
                                    autocomplete="body" value="{{ $comment->body }}">
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
