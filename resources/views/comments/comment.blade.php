@foreach ($post->comment as $comment)
    <div class="display-comment">
        <strong>{{ $comment->name }}</strong>
        <p>{{ $comment->text }}</p>

        @role('writer')

            <button id="reply-comment-but">Reply</button>
            <button id="edit-comment-but">Edit</button>
            <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="delete-comment-form">
                @csrf
                @method('DELETE')
                <button type="submit" id="delete-comment-but">Delete</button>
            </form>
            
            @if($comment->parent_id === null)
                <form method="post" id="reply-form" action="{{ route('answer.comment', ['post_id' => $post->id, 'comment_id' => $comment->id]) }}" class="hide">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="reply-comment-but" value="Reply" />
                    </div>
                </form>
            @endif

            <form method="post" id="update-form" action="{{ route('comment.update', $comment->id) }}" class="hide">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <input type="text" name="text" class="form-control" value="{{ $comment->text }}" />
                </div>
                <input type="submit"  value="Update" />
                <input type="button" id='close-reply-form' value="Close">
            </form>
        @endrole
    </div>
@endforeach
