
<div class="row">
  <div class="col-md-12">
    <div class="portlet box primary">
      <div class="portlet-title">
        <div class="caption">
          <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Assign Employees
        </div>
      </div>
      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($employees as $employee)
            <tr>
              <td>{{ $employee['first_name'] }} {{ $employee['last_name'] }}</td>
              <td>{{ $employee['email'] }}</td>
              <td>{{ $employee['city']  }}</td>
              <td>{{ $employee['address'] }}</td>
              @if($employee['selected'])
                <td><a href="/owner/employees/{{ $employee['id'] }}/un-select">Remove</a></td>
              @else
                <td><a href="/owner/employees/{{ $employee['id'] }}/select">Add</a></td>
              @endIf
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-12 mar-10">
      <div class="col-xs-12 col-md-12">
        <a href="/owner/employees/hire" class="btn btn-success btn-block btn-md btn-responsive">Add Employees</a>
      </div>
    </div>
  </div>
</div>