<ul id="menu" class="page-sidebar-menu">
  <!-- DASHBOARD -->
  <li {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Dashboard</span>
    </a>
  </li>

  <!-- FIND INVESTMENT -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="rocket" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Find Investment</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
      <li>
        <a href="/investor/get-all/serbia">
          <i class="fa fa-angle-double-right"></i>
          Serbia
        </a>
      </li>
    </ul>
  </li>

  <!-- FIND INVESTMENT -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">My Investment</span>
    </a>
  </li>

</ul>
