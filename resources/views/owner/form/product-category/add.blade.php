<section class="content-header">
  <h1>Create New Product Category</h1>
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
          <form action="/owner/product-category/store" method="POST" onsubmit="return Validation()" role="form" id="create_product_category">
            <div class="col-md-12">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />

              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <input type="text" name="name" id="name" class="form-control input-md" placeholder="Name of category">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
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
