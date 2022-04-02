@extends('layouts.app')

@section('content')
<div class="container">
    <div class="update-post-block">
        <form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <p class="update-divider">TITLE</p>
            <input type="text" name="title" placeholder="post title" value="{{$post->title}}" class="update-title">

            <p class="update-divider">PREVIEW IMAGE</p>
            <input type="file" name="image" class="update-image">

            <p class="update-divider">FILL TEXT</p>
            <textarea type="text" name="text" placeholder="post text" id="post-area">
                {{$post->text}}
            </textarea>
                
            <div class="update-post-category">
                <p class="update-divider">CHOOSE CATEGORIES</p>
                @foreach ($categories as $category)
                    <input type="checkbox" name='categories[]' id="category-{{$category->id}}" value="{{$category->id}}"
                    @foreach ($post->categories as $post_cat)
                        @if ($category->id === $post_cat->category_id)
                            checked
                        @endif
                    @endforeach>
                    <label for="category-{{$category->id}}">{{$category->name}}</label><br>
                @endforeach
            </div>
            <input type="submit" value="Save">
        </form>
    </div>
@endsection
