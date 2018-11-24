<section class="content">
  <div class="row">

    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            From Date And Time
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group">
              <label>From Date</label>
              <input class="date form-control" name="from_date" type="text" placeholder="From Date">
              {!! $errors->first('from_date', '<span class="help-block text-danger">:message</span>') !!}
              <label>From Time</label>
              <input class="time form-control" name="from_time" type="text" placeholder="24h">
              {!! $errors->first('from_time', '<span class="help-block text-danger">:message</span>') !!}
            </div>
          </div>
        </div>
      </div>
      <input type="submit" name="btnSubmit" class="btn btn-success btn-md btn-responsive">
    </div>

    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            To Date And Time
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group {{ $errors->first('price', 'has-error') }}">
              <label>To Date</label>
              <input class="date form-control" name="to_date" type="text" placeholder="To Date">
              {!! $errors->first('to_date', '<span class="help-block text-danger">:message</span>') !!}
              <label>To Time</label>
              <input class="time form-control" name="to_time" type="text" placeholder="24h">
              {!! $errors->first('to_time', '<span class="help-block text-danger">:message</span>') !!}
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
