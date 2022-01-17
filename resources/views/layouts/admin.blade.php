<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
  <title>Admin - @yield('title', 'Region Photo')</title>
</head>
<body>
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.index')}}">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('setting.index')}}">Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Site</a>
            </li>
          </ul>
        </div><!-- .col-6 -->  
        <div class="col-6 d-flex justify-content-end">
          <ul class="nav">
            <li class="nav-item me-2">
              <a class="btn btn-warning" href="#">Profile</a>
            </li>
            <li class="nav-item">
            <form action="/logout" method="post">
            @csrf
            <input class="btn btn-danger" type="submit" value="Logout">
            </form>
            </li>
          </ul>
        </div><!-- .col-6 -->  
      </div><!-- .row -->  
    </div><!-- .container-fluid -->
  </header>


  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
          <x-sidebar></x-sidebar>
          @yield('sidebar')
        </div><!-- .col-2 -->
        <div class="col-10">
          @yield('content')
        </div><!-- .col-10 -->
      </div><!-- .row -->
    </div><!-- .container-fluid -->
  </main>
  <footer>

  </footer>
  @if($errors->any())
  <div class="errors">
    {!! implode('', $errors->all('<p style="color: red">:message</p>')) !!}
  </div>
  @endif
  @if (session('status'))
    <p style="color: blue;">
      {{ session('status') }}
    </p>
  @endif
  @if (session('success'))
    <p style="color: green;">
      {{ session('success') }}
    </p>
  @endif
</body>
</html>