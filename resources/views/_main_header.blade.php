<div class="container-fluid">
    <div class="brand_section">
        <a class="navbar-brand" href="#">Som List</a>
    </div>
    <ul class="header_notifications clearfix">
        <li class="dropdown">
            <span class="label label-danger">8</span>
            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-envelope"></i></a>
            <div class="dropdown-menu">
                <ul>
                    <li>
                        <img src="" alt="" width="38" height="38">
                        <p><a href="#">Lorem ipsum dolor&hellip;</a></p>
                        <small class="text-muted">14.07.2014</small>
                    </li>
                    <li>
                        <img src="" alt="" width="38" height="38">
                        <p><a href="#">Lorem ipsum dolor sit amet&hellip;</a></p>
                        <small class="text-muted">14.07.2014</small>
                    </li>
                    <li>
                        <a href="#" class="btn btn-xs btn-primary btn-block">All messages</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="dropdown" id="tasks_dropdown">
            <span class="label label-danger">14</span>
            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-tasks"></i></a>
            <div class="dropdown-menu">
                <ul>
                    <li>
                        <div class="clearfix">
                            <div class="label label-danger pull-right">High</div>
                            <small class="text-muted">YUK-8 (26.07.2014)</small>
                        </div>
                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                    </li>
                    <li>
                        <div class="clearfix">
                            <div class="label label-success pull-right">Medium</div>
                            <small class="text-muted">DES-14 (25.07.2014)</small>
                        </div>
                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                    </li>
                    <li>
                        <a href="#" class="btn btn-xs btn-primary btn-block">All tasks</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="dropdown">
            <span class="label label-primary">2</span>
            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-bell"></i></a>
            <div class="dropdown-menu">
                <ul>
                    <li>
                        <p>Lorem ipsum dolor&hellip;</p>
                        <small class="text-muted">10:55</small>
                    </li>
                    <li>
                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                        <small class="text-muted">14.07.2014</small>
                    </li>
                    <li>
                        <a href="#" class="btn btn-xs btn-primary btn-block">All Alerts</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    @if (Auth::guest())
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/auth/login') }}">Login</a></li>
            <li><a href="{{ url('/auth/register') }}">Register</a></li>
        </ul>
    @else
        <div class="header_user_actions dropdown">
            <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                <a href="#">
                    <img src="" alt="" title="user name (email@example.com)" width="38" height="38">
                    {{ Auth::user()->name }}
                </a>
                <span class="caret"></span>
            </div>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="pages-user_profile.html">User Profile</a></li>
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            </ul>
        </div>
    @endif

    <div class="search_section hidden-sm hidden-xs">
        <input type="text" class="form-control input-sm">
        <button class="btn btn-link btn-sm" type="button"><span class="icon_search"></span></button>
    </div>
</div>