

<nav class="navbar navbar-expand-md bg-dark navbar-dark" style="background-color: rgb(0,0,0,0.7) !important;position: absolute;top:0;width: 100%;">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Tokan.pk</a>
  
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        @if (!empty(session('adminid')) && !empty($username) )
            <li class="nav-item">
              <a class="nav-link" href="/index"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/tokens"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-receipt" aria-hidden="true"></i>Tokens</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/operators"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-users" aria-hidden="true"></i>Operators</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/branches"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-list" aria-hidden="true"></i>Branch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-building" aria-hidden="true"></i>{{$username}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-chevron-circle-right" aria-hidden="true"></i>Logout</a>
            </li>
        @elseif(!empty(session('id')) && !empty($username))
            <li class="nav-item">
              <a class="nav-link" href="/index"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/profile"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-user-circle" aria-hidden="true"></i>{{$username}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-chevron-circle-right" aria-hidden="true"></i>Logout</a>
            </li>
        @endif
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> --}}
      </ul>
    </div>
  </nav>
  