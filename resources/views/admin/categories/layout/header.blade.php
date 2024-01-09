<div class="custom-navbar">
    <!-- nav left -->
    <ul class="custom-navbar-nav">
        <li class="custom-nav-item">
            <a class="custom-nav-link">
                <i class="fas fa-bars" onclick="collapseSidebar()"></i>
            </a>
        </li>
        <li class="custom-nav-item">
        </li>
    </ul>
    <ul class="custom-navbar-nav custom-nav-right">
        <li class="custom-nav-item custom-mode">
            <a class="custom-nav-link" href="#" onclick="switchTheme()">
                <i class="fas fa-moon dark-icon"></i>
                <i class="fas fa-sun light-icon"></i>
            </a>
        </li>
        <li class="custom-nav-item custom-dropdown">
            <a class="custom-nav-link">
                <i class="fas fa-bell custom-dropdown-toggle" data-toggle="notification-menu"></i>
                <span class="custom-navbar-badge">
                    @php
                        $count = 0;
                        if (isset($notifications) && (is_array($notifications) || is_countable($notifications))) 
                        {
                            $count = count($notifications);
                        }
                    @endphp
                    {{$count}}
                </span>
            </a>
            <ul id="notification-menu" class="custom-dropdown-menu custom-notification-menu">
                <div class="custom-dropdown-menu-header">
                    <span>
                        Thông báo
                    </span>
                </div>  
                <div class="custom-dropdown-menu-content overlay-scrollbar scrollbar-hover">
                    @isset($notifications)
                        @foreach($notifications as $notification)
                            <li class="custom-dropdown-menu-item">
                                <a class="custom-dropdown-menu-link">
                                    <div>
                                        @if($notification->type === "Đang chờ được duyệt")
                                            <i class="fas fa-tasks"></i>
                                        @elseif($notification->type === "Đã được duyệt")
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($notification->type === "Duyệt xem")
                                            <i class="fas fa-paste"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                    </div>
                                    <span>
                                        {{$notification->content}}
                                        <br>
                                        <span>
                                            {{ $notification->created_at->format('Y-m-d') }}
                                        </span>
                                    </span>
                                    <div>
                                        <form action="{{route('deleteNotification',$notification->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="custom-element"><i class="fas fa-times"></i></button>                                                    
                                        </form>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @endisset
                </div>
                <div class="custom-dropdown-menu-footer">
                    <span>
                        
                    </span>
                </div>
            </ul>
        </li>
        <li class="custom-nav-item custom-avt-wrapper">
            <div class="custom-avt custom-dropdown">
                @if(Auth::check())
                    @php
                        $tk = Auth::user();
                    @endphp
                    @if($tk->image != "daidien.jpg")
                        <img src="{{ asset('/theme/image/users/'.$tk->image) }}" class="img-fluid rounded-circle mr-3 custom-dropdown-toggle" alt="User image" data-toggle="user-menu">
                    @else
                        <img src="{{asset('/theme/image/'.$user->image)}}" alt="User image" class="img-fluid rounded-circle mr-3 custom-dropdown-toggle" data-toggle="user-menu">
                    @endif
                @endif
            </div>
        </li>
    </ul>
</div>
<div class="custom-sidebar">
    <ul class="custom-sidebar-nav">
        <li class="custom-sidebar-nav-item">
            <a href="{{route('getHomepage')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-home"></i>
                </div>
                <span>
                    Trang chủ
                </span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getAdminPost')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-tasks"></i>
                </div>
                <span>Quản lý bài viết</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getCategoryList')}}" class="custom-sidebar-nav-link active">
                <div>
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span>Quản lý danh muc</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getApproveProjectList')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <span>Duyệt đề án</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getApproveViewList')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-paste"></i>
                </div>
                <span>Duyệt yêu cầu xem</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getUserList')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-users"></i>
                </div>
                <span>Quản lý người dùng</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('admin.getMyprofileAdmin')}}" class="custom-sidebar-nav-link ">
                <div>
                    <i class="fas fa-user-tie"></i>
                </div>
                <span>Trang cá nhân</span>
            </a>
        </li>
        <li class="custom-sidebar-nav-item">
            <a href="{{route('getLogout')}}" class="custom-sidebar-nav-link">
                <div>
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>
