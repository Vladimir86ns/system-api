<ul id="menu" class="page-sidebar-menu">

  <!-- DASHBOARD -->
  <li {!! (Request::is('dashboard') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
      data-loop="true"></i>
      <span class="title">Dashboard</span>
    </a>
  </li>

  <!-- ADD NEW PORDUCTS -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="">
      <i class="livicon" data-name="rocket" data-size="18" data-c="#418BCA" data-hc="#418BCA"
         data-loop="true"></i>
      <span class="title">Add New</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">

      <!-- ADD PRODUCT CATEGORY -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="/owner/create-product-category">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Product Category</span>
        </a>
      </li>

      <!-- ADD EMPLOYEE -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Employee</span>
        </a>
      </li>

      <!-- ADD NEW PRODUCT -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">New Product</span>
        </a>
      </li>

    </ul>
  </li>

  <!-- SEE ALL PRODUCTS -->
  <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
      <i class="livicon" data-name="rocket" data-size="18" data-c="#418BCA" data-hc="#418BCA"
         data-loop="true"></i>
      <span class="title">See All</span>
      <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">

      <!-- SEE ALL PRODUCT CATEGORY -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Product Categories</span>
        </a>
      </li>

      <!-- SEE ALL EMPLOYEE -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Employees</span>
        </a>
      </li>

      <!-- ADD NEW PRODUCT -->
      <li {!! (Request::is('groups') || Request::is('groups/create') || Request::is('groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
          <i class="livicon" data-name="piggybank" data-size="18" data-c="#418BCA" data-hc="#418BCA"
             data-loop="true"></i>
          <span class="title">Products</span>
        </a>
      </li>

    </ul>
  </li>


</ul>
