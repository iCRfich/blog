<div class="col-md-3 sidebar widget-area"">
    <aside class="widget" id="search-widget">
        <h4>SEARCH</h4>

        <form action="{{route('search')}}" method="post">
            @csrf
            <input type="text" name="text" id="">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </aside>

    <aside class="widget" id="last-posts-widget">
        <h4>LAST POSTS</h4>
        <ul>
            @foreach ($last as $post)
            <li>
                <a href="{{route('post.show',$post->id)}}"> {{$post->title}} </a>
            </li>
        @endforeach
        </ul>
    </aside>

    <aside class="widget" id="about-widget">
        <h4>ABOUT</h4>
        <img src="{{url('/images/'.$about->image)}}" alt="" class="about-image">
        <p>{{$about->surname}} {{$about->name}}</p>
        <p id="about">
            {!! $about->about !!}
        </p>
    </aside>

    <aside class="widget" id="contact-widget">
        <h4>CONTACTS</h4>
        @if ($about->twitter)
            <div>
                <i class="fa-brands fa-twitter"></i>
                <a href="{{$about->twitter}}">Twitter</a> 
            </div>
        @endif
        @if ($about->skype)
            <div>
                <i class="fa-brands fa-skype"></i>
                <span>Skype: {{$about->skype}}</span>
            </div>
        @endif
        @if ($about->facebook)
            <div>
                <i class="fa-brands fa-facebook"></i>
                <a href="{{$about->facebook}}">Facebook</a>
            </div>
        @endif
        @if ($about->instagram)
            <div>
                <i class="fa-brands fa-instagram"></i>
                <a href="{{$about->instagram}}">Instagram</a>
            </div>
        @endif
        @if ($about->email)
            <div>
                <i class="fa-solid fa-at"></i>
                <span>Email: {{$about->email}}</span>
            </div>
        @endif
        @if ($about->youtube)
            <div>
                <i class="fa-brands fa-youtube"></i>
                <a href="{{$about->youtube}}">Youtube</a>
            </div>
        @endif
    </aside>
</div>