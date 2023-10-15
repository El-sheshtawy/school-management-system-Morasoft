<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
           @if(auth()->guard('web')->check())
               @include('layouts.main-sidebar.admin-main-sidebar')
            @elseif(auth()->guard('student')->check())
               @include('layouts.main-sidebar.student-main-sidebar')
            @elseif(auth()->guard('teacher')->check())
               @include('layouts.main-sidebar.teacher-main-sidebar')
            @elseif(auth()->guard('parent')->check())
                @include('layouts.main-sidebar.parent-main-sidebar')
            @endif
        </div>
    </div>
</div>
