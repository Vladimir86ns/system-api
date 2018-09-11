<ul id="menu" class="page-sidebar-menu">

  <!-- DASHBOARD -->
  <li {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Dashboard</span>
    </a>
  </li>

  <!-- ADD PRODUCT CATEGORY -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Add Product Category</span>
    </a>
  </li>

  <!-- ADD EMPLOYEE -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Add Employee</span>
    </a>
  </li>

  <!-- ALL EMPLOYEES -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">All Employees</span>
    </a>
  </li>

  <!-- ALL PRODUCTS -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">All Products</span>
    </a>
  </li>

  <!-- ADD NEW PRODUCT -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Add New Product</span>
    </a>
  </li>

</ul>
