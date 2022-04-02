@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 content-area">
            @foreach ($posts as $post)
            <div class="post-block col-lg">
                <img src="{{url('/images/'.$post->image)}}" alt="" class="poster-image">
                <a href="{{route('post.show',$post->id)}}" class="post-title">{{$post->title}}</a>

                <div class="post-info">
                    <span><i class="fa-solid fa-calendar"></i>{{$post->created_at->format('Y-m-d') }}</span>
                    <span><i class="fa-solid fa-comments"></i>
                        @if (count($post->comment)) Comments count: {{count($post->comment)}}
                        @else No comments
                        @endif
                    </span>
                </div>

                <div class="post-text">
                    {!! ($post->text) !!}
                </div>
                <a href="{{route('post.show',$post->id)}}" class="read-more">READ MORE</a>
            </div>
        @endforeach
      </div>
      @include('sidebar')
    </div>

</div>
@endsection
