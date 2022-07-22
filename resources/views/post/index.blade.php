@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4>Manage Posts</h4>
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm mb-2" style="float: right"><i>Add Post</i></a>
            <table class="table table-bordered table-hover">
                <thead>
                    <th width="80px">Id</th>
                    <th>Post</th>
                    <th>Comment</th>
                    <th width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->comments->count()}}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm"><i> view</i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
