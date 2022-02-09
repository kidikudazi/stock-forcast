<aside class="app-navbar">
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu" id="sidebarNav">
            <li class="nav-static-title">Dashboard</li>

            <li>
                <a href="{{ url('user/home') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-home"></i><span class="nav-title">Home</span>
                </a>
            </li>

            <li>
                <a href="{{ url('user/profile') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-user"></i><span class="nav-title">Profile</span>
                </a>
            </li>

            <li>
                <a href="{{ url('user/stocks') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-list"></i><span class="nav-title">Farm Stocks</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" aria-expanded="false" onclick="document.getElementById('logout-form2').submit();">
                    <i class="nav-icon ti ti-power-off"></i><span class="nav-title">Logout</span>
                </a>
                <form method="POST" id="logout-form2" action="{{ url('/user/logout') }}">@csrf</form>
            </li>

        </ul>
    </div>
</aside>
