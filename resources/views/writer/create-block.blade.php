@extends('layouts.app')

@section('content')
<div class="container">
    <div class="tabs">
        <button class="tab" value="create-post">Post</button>
        <button class="tab" value="create-category">Category</button>
        <button class="tab" value="create-about">About</button>
      </div>

    <div id="create-post" class="tab-content hide">
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="divider">TITLE</p>
            <input type="text" name="title" placeholder="post title" class="title">

            <p class="divider">PREVIEW IMAGE</p>
            <input type="file" name="image">
            
            <p class="divider">FILL TEXT</p>
            <textarea type="text" name="text" placeholder="post text" id="post-area">
            </textarea>
        
            <div>
                <p class="divider">CHOOSE CATEGORIES</p>
                @foreach ($categories as $category)
                    <input type="checkbox" name='categories[]' id="category-{{$category->id}}" value="{{$category->id}}">
                    <label for="category-{{$category->id}}">{{$category->name}}</label><br>
                @endforeach
            </div>
            
            <input type="submit" value="Save">
            <div>

            </div>
        </form>
    </div>
    <div id="create-category" class="tab-content  hide">
        <div class="add-new-category">
            <p class="divider">NEW CATEGORY</p>
            <form action="{{route('category.store')}}" method="POST" class="add-category-form">
                @csrf
                <input type="text" name="name" placeholder="category name">
                <input type="submit" value="Save">
            </form>
        </div>

        <p class="all-categories-title">ALL CATEGORIES</p>
        @foreach ($categories as $category)
            <div class="categories-block">
                <span class="category-name">{{$category->name}}</span>
                <button class="open-edit-category">Edit</button>
                <span class="hide edit-category-block">
                    <form action="{{route('category.update', $category->id)}}" enctype="multipart/form-data" method="post">
                        @method('PATCH')
                        @csrf
                        <input type="text" name="name" value={{$category->name}} placeholder="new category name">
                        <input type="submit" value="Update">
                    </form>
                    <button class="close-category-edit">Close</button>
                </span>
                <form action="{{route('category.destroy', $category->id) }}" method="POST" class="delete-category">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="DELETE" class="delete-category-btn">
                </form>
            </div>
        @endforeach
    </div>
    <div id="create-about" class="tab-content  hide">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('about.update', Auth::id())}}" enctype="multipart/form-data" method="post">
            @method('PATCH')
            @csrf
            <label for="user-name">User name</label>
            <input type="text" id="user-name" name="name" placeholder="name" @if(Auth::user()->about)  value="{{Auth::user()->about->name}}" @endif>
            
            <label for="user-surname">User Surname</label>
            <input type="text"  id="user-surname" name="surname" placeholder="surname" @if(Auth::user()->about)  value="{{Auth::user()->about->surname}}" @endif>
            
            <label for="user-image">User Photo/Image</label>
            <input type="file"  id="user-image" name="image" >

            <label for="user-title">Title: </label>
            <input type="text"  id="user-title" name="title" placeholder="title" @if(Auth::user()->about)  value="{{Auth::user()->about->title}}" @endif>
            
            <label for="user-about">About yourself</label>
            <textarea type="text"  id="user-about" name="about" placeholder="about"> @if(Auth::user()->about)  {{Auth::user()->about->about}} @endif </textarea>
            
            <label for="user-twitter">Twitter link: <i class="fa-brands fa-twitter"></i></label>
            <input type="text"  id="user-twitter" name="twitter" placeholder="twitter link" @if(Auth::user()->about)  value="{{Auth::user()->about->twitter}}" @endif>
            
            <label for="user-skype">Skype: <i class="fa-brands fa-skype"></i></label>
            <input type="text"  id="user-skype" name="skype" placeholder="skype link" @if(Auth::user()->about)  value="{{Auth::user()->about->skype}}" @endif>
            
            <label for="user-facebook">Facebook link: <i class="fa-brands fa-facebook"></i></label>
            <input type="text"  id="user-facebook" name="facebook" placeholder="facebook link" @if(Auth::user()->about)  value="{{Auth::user()->about->facebook}}" @endif>
            
            <label for="user-instagram">Instagram link: <i class="fa-brands fa-instagram"></i></label>
            <input type="text"  id="user-instagram" name="instagram" placeholder="instagram link" @if(Auth::user()->about)  value="{{Auth::user()->about->instagram}}" @endif>
            
            <label for="user-email">Email:<i class="fa-solid fa-at"></i></label>
            <input type="text"  id="user-email" name="email" placeholder="email link" @if(Auth::user()->about)  value="{{Auth::user()->about->email}}" @endif>
            
            <label for="user-youtube">Youtube link: <i class="fa-brands fa-youtube"></i></label>
            <input type="text"  id="user-youtube" name="youtube" placeholder="youtube chanel link" @if(Auth::user()->about)  value="{{Auth::user()->about->youtube}}" @endif>
            <input type="submit" value="Save">
        </form> 
        <img src="{{Auth::user()->about->image}}" alt="">
    </div>
</div>
@endsection

