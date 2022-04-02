@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 content-area">
            <div class="post-block col-lg">
                <img src="{{url('/images/'.$post->image)}}" alt="" class="poster-image">
                <p class="post-title">{{$post->title}}</p>

                @role('writer')
                    <a href="{{route('post.edit',$post->id)}}" class="go-edit">GO EDIT</a>
                @endrole
                <div class="post-info">
                    <span><i class="fa-solid fa-calendar"></i>{{$post->created_at->format('Y-m-d') }}</span>
                    <span><i class="fa-solid fa-comments"></i>
                        @if (count($post->comment)) Comments count: {{count($post->comment)}}
                        @else No comments
                        @endif
                    </span>
                </div>

                <div id="post-show-text">
                    {!! $post->text !!}
                </div>
            </div>

            <div class="add-comment-block">
                <form action="{{route('comment.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
        
                    <label for="comment-email">Email</label>
                    <input type="text" name="email" id="comment-email"   @if (Auth::user()) value="{{Auth::user()->email}}" readonly @endif>
        
                    <label for="comment-name">Name</label>
                    <input type="text" name="name" id="comment-name" @if (Auth::user()) value="{{Auth::user()->name}}" readonly @endif>
        
                    <label for="comment-text">Text</label>
                    <textarea name="text" id="" id="comment-text"></textarea>
                    <button type="submit">Add comment</button>
                </form>
            </div>

            @include('comments.comment')
      </div>
      @include('sidebar')
    </div>

</div>
@endsection
