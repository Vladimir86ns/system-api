<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- global level css -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <!-- end of global level css -->
  <!-- page level css -->
  <link href="{{ asset('assets/css/pages/login2.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
  <!-- styles of the page ends-->
</head>

<body>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">

      <div class="col-md-4">
        <div class="alert alert-info text-center">
          <h2>Total Investitions</h2>
          <p>{{  $vgSystem['total_investitions'] }}</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="alert alert-warning text-center">
          <h2>Total Invested</h2>
          <p>{{ $vgSystem['collected_to_date'] }}</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="alert alert-success text-center">
          <h2>Available To Invest</h2>
          <p>{{ $vgSystem['available_to_invest'] }}</p>
        </div>
      </div>

    </div>
  </div> <!-- /container -->

  <div class="container">
    <div class="row vertical-offset-100">
      <div class=" col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">

        <div id="notific">
          @include('notifications')
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title text-center">Chose Status</h3>
          </div>

          <div class="panel-body">
            <a href="/employee/login" class="btn btn-primary btn-block btn-lg">Employee ({{ $vgSystem['employee'] }})</a>
            <a href="/owner/login" class="btn btn-primary btn-block btn-lg">Owner ({{ $vgSystem['owner'] }})</a>
            <a href="/investor/login" class="btn btn-primary btn-block btn-lg">Investor ({{ $vgSystem['investor'] }})</a>
            <a href="/investment-admin/login" class="btn btn-primary btn-block btn-lg">Investment Admin</a>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- global js -->
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js-->
    <script src="{{ asset('assets/js/TweenLite.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/login2.js') }}" type="text/javascript"></script>
    <!-- end of page level js-->
  </body>
  </html>
