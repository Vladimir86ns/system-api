<section class="content-header">
  <h1>Edit Product</h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            Edit Product
          </h3>
        </div>
        <div class="panel-body">
          <form action="/owner/product/update/{{ $selectedProduct['id'] }}" method="POST" onsubmit="return Validation()" role="form" id="product">

            <div class="col-md-12">
              <label>Product category:</label>
              <div class="form-group {{ $errors->first('product_category_id', 'has-error') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <select class="form-control" name="product_category_id">
                  @foreach ($productCategories as $productCategory)
                    @if($productCategory['id'] == $selectedProduct->productCategory['id'])
                      <option value="{{ $productCategory['id'] }}" selected>{{ $productCategory['name'] }}</option>
                    @endif
                      <option value={{ $productCategory['id'] }}>{{ $productCategory['name'] }}</option>
                  @endforeach
                </select>
                {!! $errors->first('product_category_id', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Name:</label>
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <input type="text" name="name" id="name" class="form-control input-md" value="{{ $selectedProduct['name'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Type:</label>
              <div class="form-group {{ $errors->first('type', 'has-error') }}">
                <input type="text" name="type" id="type" class="form-control input-md" value="{{ $selectedProduct['type'] }}">
                {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Size:</label>
              <div class="form-group {{ $errors->first('size', 'has-error') }}">
                <input type="text" name="size" id="size" class="form-control input-md" value="{{ $selectedProduct['size'] }}">
                {!! $errors->first('size', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Cost:</label>
              <div class="form-group {{ $errors->first('cost', 'has-error') }}">
                <input type="text" name="cost" id="cost" class="form-control input-md" value="{{ $selectedProduct['cost'] }}">
                {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Price:</label>
              <div class="form-group {{ $errors->first('price', 'has-error') }}">
                <input type="text" name="price" id="price" class="form-control input-md" value="{{ $selectedProduct['price'] }}">
                {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Picture:</label>
              <div class="form-group {{ $errors->first('picture', 'has-error') }}">
                <input type="text" name="picture" id="picture" class="form-control input-md" value="{{ $selectedProduct['picture'] }}">
                {!! $errors->first('picture', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <label>Time To Prepare:</label>
              <div class="form-group {{ $errors->first('time_to_prepare', 'has-error') }}">
                <input type="text" name="time_to_prepare" id="time_to_prepare" class="form-control input-md" value="{{ $selectedProduct['time_to_prepare'] }}">
                {!! $errors->first('time_to_prepare', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12 mar-10">
              <div class="col-xs-6 col-md-6">
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Save" class="btn btn-success btn-block btn-md btn-responsive">
              </div>
              <div class="col-xs-6 col-md-6">
                <a href="/owner/product/all" class="btn btn-danger btn-block btn-md btn-responsive">Cancel</a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
</section>
