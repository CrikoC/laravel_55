<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li class="{{ Request::is('categories.create') ? 'active' : '' }}">
                            <a href="{{route('categories.create')}}">Create New</a>
                        </li>
                        <li class="{{ Request::is('categories.index') ? 'active' : '' }}">
                            <a href="{{route('categories.index')}}">Show all</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pushpin"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li class="{{ Request::is('posts.create') ? 'active' : '' }}">
                            <a href="{{route('posts.create')}}">Create New</a>
                        </li>
                        <li class="{{ Request::is('posts.index') ? 'active' : '' }}">
                            <a href="{{route('posts.index')}}">Show all</a>
                        </li>
                    </ul>

                <li class="{{ Request::is('tags.index') ? 'active' : '' }}">
                    <a href="{{ route('tags.index') }}">Tags<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tag"></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>