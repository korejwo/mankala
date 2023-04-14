<div class="position-relative navbar-menu d-none d-lg-block" style="z-index: 9999;">
    <div class="position-fixed top-0 start-0 bottom-0 w-75 mw-sm-xs pt-6 bg-dark overflow-auto">
        <div class="py-6 px-6">
            <div>
                <h3 class="mb-2 text-secondary text-uppercase small">Main</h3>
                <ul class="nav flex-column mb-auto">
                    {!! nav_item('dashboard', 'Dashboard') !!}
                    @guest
                        {!! nav_item('login', 'Login') !!}
                        {!! nav_item('register', 'Register') !!}
                    @else
                        {!! nav_item('logout', 'Logout') !!}
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>
