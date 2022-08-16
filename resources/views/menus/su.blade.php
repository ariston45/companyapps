<li class="{{ Request::is('home*') == true  ? 'active' : '' }}">
  <a href="{{ url('/home') }}"><i class="fa fa-graduation-cap"></i> <span>Dashboard</span>
  </a>
</li>

<li class="{{ Request::is('user*') == true  ? 'active' : '' 
|| Request::is('create-user*') == true  ? 'active' : ''}}">
  <a href="{{ url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a>
</li>