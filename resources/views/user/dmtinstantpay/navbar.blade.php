<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{route('dmt.bank.account')}}">Bank List</a>
                </li> --}}

                <li class="nav-item {{ request()->routeIs('dmt.remitter-profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dmt.remitter-profile') }}">Remitter Register</a>
                </li>

                <li class="nav-item {{ request()->routeIs('transaction.history') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transaction.history') }}">History</a>
                </li>
            </ul>
        </div>
    </div>
</nav>