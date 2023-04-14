<div class="position-relative navbar-menu d-none d-lg-block" style="z-index: 9999;">
    <div class="position-fixed top-0 start-0 bottom-0 w-75 mw-sm-xs pt-6 bg-dark overflow-auto">
        <div class="py-6 px-6">
            <div>
                <h3 class="mb-2 text-secondary text-uppercase small">Main</h3>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item nav-pills">
                        <a class="nav-link text-white p-3 d-flex align-items-center" href="{{ route('dashboard') }}">
                            <span class="small">Dashboard</span>
                        </a>
                    </li>
                    @guest
                        <li class="nav-item nav-pills">
                            <a class="nav-link text-white p-3 d-flex align-items-center" href="{{ route('login') }}">
                                <span class="small">Login</span>
                            </a>
                        </li>
                        <li class="nav-item nav-pills">
                            <a class="nav-link text-white p-3 d-flex align-items-center" href="{{ route('register') }}">
                                <span class="small">Register</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item nav-pills">
                            <a class="nav-link text-white p-3 d-flex align-items-center" href="{{ route('logout') }}">
                                <span class="small">Logout</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>
