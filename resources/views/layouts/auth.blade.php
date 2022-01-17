<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('/css/auth.css')}}">
  <title>Users - @yield('title', 'Region Photo')</title>
</head>
<body>
  
  <div class="container">
    <div class="row">
      <div class="content align-items-center">
        @if($errors->any())
        <div class="errors">
          <div class="alert alert-danger" role="alert">
            {!! implode('', $errors->all('<p style="color: red">:message</p>')) !!}
          </div>
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-info" role="alert">
          {{ session('status') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>
        @endif
        @yield('content')
      </div><!-- .content -->
    </div><!-- .row -->  
  </div><!-- .container -->

</body>
</html>