  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <ul class="nav">
            @foreach ($links as $link)
            <li class="nav-item">
              <a class="nav-link {{$link['class']}}" aria-current="page" href="{{$link['route']}}">{{$link['title']}}</a>
            </li>
            @endforeach
          </ul>
        </div><!-- .col-6 -->  
        <div class="col-6 d-flex justify-content-end">
          <ul class="nav">
            <li class="nav-item">
                <form action="/logout" method="post">
                    @csrf
                    <input class="nav-link" type="submit" value="Logout">
                </form>
            </li>
          </ul>
        </div><!-- .col-6 -->  
      </div><!-- .row -->  
    </div><!-- .container-fluid -->
  </header>