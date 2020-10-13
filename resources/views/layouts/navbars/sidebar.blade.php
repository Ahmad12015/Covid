<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a class="simple-text logo-normal">
      لوحة التحكم
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>الرئيسية</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'all management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('patients') }}">
          <i class="material-icons text-dark">content_paste</i>
            <p>جدول جميع الحالات</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'healthy management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('patients.healthy') }}">
          <i class="material-icons text-success">content_paste</i>
            <p>إدارة المتعافين</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'contact management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('patients.contact') }}">
          <i class="material-icons text-warning">content_paste</i>
            <p>إدارة المخالطين</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'injured management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('patients.injured') }}">
          <i class="material-icons text-danger">content_paste</i>
            <p>إدارة المصابين</p>
        </a>
      </li>
      @if(auth()->user()->type == 1)
            <li class="nav-item{{ $activePage == 'place table' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('place_table') }}">
                    <i class="material-icons text-danger">place</i>
                    <p>الأماكن و المحلات</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'user table' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user_table')}}">
                    <i class="material-icons text-primary">account_box</i>
                    <p>إدارة المشرفين</p>
                </a>
            </li>
        @endif
    </ul>
  </div>
</div>
