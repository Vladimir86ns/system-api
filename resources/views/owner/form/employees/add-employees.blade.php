<section class="content-header">
  <h1>Create New Product</h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="livicon" data-name="plane-up" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Create New Product Category
          </h3>
        </div>
        <div class="panel-body">
          <form action="/owner/store-product" method="POST" onsubmit="return Validation()" role="form" id="product_category">

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('product_categories_id', 'has-error') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <select class="form-control" name="product_categories_id">
                  <option value="" selected disabled>Select product category</option>
                  @foreach ($employees as $employee)
                    <option value={{ $employee['id'] }}>{{ $employee['first_name'] }} {{ $employee['last_name'] }}</option>
                  @endforeach
                </select>
                {!! $errors->first('product_categories_id', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12 mar-10">
              <div class="col-xs-6 col-md-6">
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Create" class="btn btn-success btn-block btn-md btn-responsive">
              </div>
              <div class="col-xs-6 col-md-6">
                <input type="reset" value="Cancel" class="btn btn-danger btn-block btn-md btn-responsive">
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
</section>
