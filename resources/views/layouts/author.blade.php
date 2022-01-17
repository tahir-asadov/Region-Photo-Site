<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('/css/users.css')}}">
  <title>Users - @yield('title', 'Region Photo')</title>
</head>
<body>
  <x-user-header></x-user-header>
  <div class="notifications">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if($errors->any())
          <div class="errors">
            {!! implode('', $errors->all('<p style="color: red">:message</p>')) !!}
          </div>
          @endif
          @if (session('status'))
            <p class="color: green;">
              {{ session('status') }}
            </p>
          @endif
          @if (session('success'))
            <p class="color: green;">
              {{ session('success') }}
            </p>
          @endif  
        </div><!-- .col-12 -->  
      </div><!-- .row -->
    </div><!-- .container-fluid -->  
  </div><!-- .notifications -->
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          @yield('content')
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!-- .container-fluid -->
  </main>

</body>
</html>