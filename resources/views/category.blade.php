@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       @foreach ($category_post as $item)
         <div>
            @if ($item->post->image)
                <img src="{{$item->post->image}}" alt="">
            @endif
            <a href="{{route('post.show',$item->post->id)}}">{{$item->post->title}}</a>
        </div> 
       @endforeach
    </div>
</div>
@endsection
