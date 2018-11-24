
{{ Form::open(['url' => "/owner/company/" . Auth::user()->company->id . "/employee/schedule", 'method' => 'POST']) }}
<div class="row">
  <div class="col-md-12">
    <div class="portlet box primary">
      <div class="portlet-title">
        <div class="caption">
          All Employees
        </div>
      </div>
      <div class="portlet-body flip-scroll">
        <form action="/owner/product/store" enctype="multipart/form-data" method="POST" onsubmit="return Validation()" role="form" id="product_category">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
          <tr>
            <th>Full Name</th>
            <th>Employee ID</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          {{  Form::token() }}
          @foreach ($allEmployees as $employee)
            <tr>
              <td>{{ $employee['first_name'] }}  {{ $employee['last_name'] }}</td>
              <td>{{ '123'  }}</td>
              <td>
                {!! Form::checkbox($employee['id'], null, false); !!}
              </td>
            </tr>
          @endforeach
          </tbody>
          </table>
        {!! $errors->first('employee_check', '<span class="help-block text-danger">:message</span>') !!}
        {{ $allEmployees->links() }}
      </div>
    </div>
  </div>
</div>

@include('owner.form.employee-schedule.employee-schedule-time-form');

{{ Form::close() }}

@section('footer_scripts')'
<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>
@stop
