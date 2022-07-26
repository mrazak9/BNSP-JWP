@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>Manage Posts</h4>
                <label for="cari" class="block mb-3 font-medium text-gray-700 text-md">Cari Data Prospect :
                </label>
                <form action="{{ route('posts.cari') }}" method="GET">

                    <select id="tag_id" name="tag_id" autocomplete="tag_id"
                        class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        <option>Pilih Tags</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">
                                {{$tag->value }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-success btn-sm mb-2">
                        Cari
                    </button>
                </form>
                <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm mb-2" style="float: right"><i>Add
                        Post</i></a>

                <table class="table table-bordered table-hover">
                    <thead>
                        <th width="80px">Id</th>
                        <th>Post</th>
                        <th>Comment</th>
                        <th width="150px">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm"><i>
                                            view</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
