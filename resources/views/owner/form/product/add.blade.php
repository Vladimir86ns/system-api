<section class="content-header">
  <h1>Create New Product</h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            Create New Product
          </h3>
        </div>
        <div class="panel-body">
          <form action="/owner/product/store" method="POST" onsubmit="return Validation()" role="form" id="product_category">

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('product_category_id', 'has-error') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <select class="form-control" name="product_category_id">
                  <option value="" selected disabled>Select product category</option>
                  @foreach ($productCategories as $productCategory)
                    <option value={{ $productCategory['id'] }}>{{ $productCategory['name'] }}</option>
                  @endforeach
                </select>
                {!! $errors->first('product_category_id', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <input type="text" name="name" id="name" class="form-control input-md" placeholder="Name">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('type', 'has-error') }}">
                <input type="text" name="type" id="type" class="form-control input-md" placeholder="Type">
                {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('size', 'has-error') }}">
                <input type="text" name="size" id="size" class="form-control input-md" placeholder="Size">
                {!! $errors->first('size', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('cost', 'has-error') }}">
                <input type="text" name="cost" id="cost" class="form-control input-md" placeholder="Cost">
                {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('price', 'has-error') }}">
                <input type="text" name="price" id="price" class="form-control input-md" placeholder="Price">
                {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('picture', 'has-error') }}">
                <input type="text" name="picture" id="picture" class="form-control input-md" placeholder="Picture Link">
                {!! $errors->first('picture', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('time_to_prepare', 'has-error') }}">
                <input type="text" name="time_to_prepare" id="time_to_prepare" class="form-control input-md" placeholder="Time to prepare">
                {!! $errors->first('time_to_prepare', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12 mar-10">
              <div class="col-xs-6 col-md-6">
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" class="btn btn-success btn-block btn-md btn-responsive">
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
