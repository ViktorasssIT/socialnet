<nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-5 d-flex" role="navigation">
    <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">Socialize</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            @if (Auth::check())
            <ul class="navbar-nav mr-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Timeline</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('friends.index') }}">Friends</a></li>
            </ul>
            <form class="form-inline" role="search" action="{{ route('search.results') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find people">
                </div>
                <button type="submit" class="btn btn-outline-info">Search</button>
            </form>
            @endif
            <ul class="navbar-nav">
                @if (Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Update profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('auth.signout') }}">Sign out</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="{{ route('auth.signup') }}">Sign up</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('auth.signin') }}">Sign in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
