@foreach ($comments as $comment)
    <div class="display-comment" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <p>Date: {{ $comment->created_at }}</p>
        @if ($comment->user_id == Auth::user()->id)
            <div class="float-right">
                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure want to deletes this data ?')">Delete</a>
            </div>
        @endif
        <hr />
        @if ($comment->parent_id == null)
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Reply" />
                </div>
                <hr />
            </form>
        @endif

        @include('post.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
