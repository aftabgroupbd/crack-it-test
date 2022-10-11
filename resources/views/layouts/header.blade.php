<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('/')}}">Crack It</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                @if(!auth()->user())
                    <li class="nav-item"><a class="nav-link" href="{{route('/')}}">login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{route('/')}}">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contacts.index')}}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" role="button" onClick="logout()">Logout</a></li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>