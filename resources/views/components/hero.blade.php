<!-- Hero Section -->
<section class="hero-section" style="background-image: url(/storage/post_images/{{$background_image}})">
    <div class="row row-top">
        <div class="container">
            <div class="left">
                <a href="/">REGION PHOTO</a>
            </div><!-- .left -->
            <div class="right">
                @auth
                <a href="{{route('author.upload')}}"><i class="fas fa-cloud-upload-alt"></i>Upload</a>
                <a href="{{route('author.profile')}}"><i class="fas fa-user"></i>{{auth()->user()->name}}</a>
                @role('super-admin')
                <a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                @endrole
                <form action="/logout" method="post">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i>Log out</button>
                </form>
                @endauth
                @guest
                <a href="/login"><i class="fas fa-sign-in-alt"></i>Login</a>
                <a href="/register"><i class="fas fa-user-plus"></i>Register</a>
                @endguest
            </div><!-- .right -->
        </div><!-- .container -->
    </div><!-- .row row-top -->
    <div class="row row-middle">
        <div class="container">
            <div>
                <form action="/">
                    <input value="{{request('s')}}" type="text" name="s" placeholder="Search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <x-cities></x-cities>
            </div>
        </div><!-- .container -->
    </div><!-- .row row-middle -->
</section><!-- .hero-section -->