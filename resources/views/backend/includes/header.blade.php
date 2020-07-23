<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="{{asset("img/backend-logo.jpg")}}" width="97" height="40" alt="{{ app_name() }}"></a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>

    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3">
            <a class="c-header-nav-link" href="{{ route('frontend.index') }}" target="_blank">
                <i class="c-icon cil-external-link"></i>&nbsp;
                {{ app_name() }}
            </a>
        </li>
    </ul>

    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown d-md-down-none mx-2">
            <?php
            $notifications = optional(auth()->user())->unreadNotifications;
            $notifications_count = optional($notifications)->count();
            $notifications_latest = optional($notifications)->take(5);
            ?>
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="c-icon cil-bell"></i>&nbsp;
                @if($notifications_count)<span class="badge badge-pill badge-danger">{{$notifications_count}}</span>@endif
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-light">
                    <strong>You have {{$notifications_count}} notifications</strong>
                </div>
                @if($notifications_latest)
                @foreach($notifications_latest as $notification)
                @php
                $notification_text = isset($notification->data['title'])? $notification->data['title'] : $notification->data['module'];
                @endphp
                <a class="dropdown-item" href="{{route("backend.notifications.show", $notification)}}">
                    <i class="c-icon {{isset($notification->data['icon'])? $notification->data['icon'] : 'cil-bullhorn'}} "></i>&nbsp;{{$notification_text}}
                </a>
                @endforeach
                @endif
            </div>
        </li>

        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>

                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-user"></i>&nbsp;
                    {{ Auth::user()->name }}
                </a>
                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-at"></i>&nbsp;
                    {{ Auth::user()->email }}
                </a>
                <a class="dropdown-item" href="{{ route("backend.notifications.index") }}">
                    <i class="c-icon cil-bell"></i>&nbsp;
                    Notifications <span class="badge badge-danger ml-auto">{{$notifications_count}}</span>
                </a>

                <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="c-icon cil-account-logout"></i>&nbsp;
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf  </form>
            </div>
        </li>
    </ul>
    <div class="c-subheader justify-content-between px-3">
        <ol class="breadcrumb border-0 m-0">
            @yield('breadcrumbs')
        </ol>
        <div class="c-subheader-nav d-md-down-none mfe-2">
            <span class="c-subheader-nav-link">
                <div class="btn-group" role="group" aria-label="Button group">
                    {{ date('l, F d, Y') }}&nbsp;<div id="openClockDisplay" class="clock" onload="showTime()"></div>
                </div>
            </span>
        </div>
    </div>
</header>
