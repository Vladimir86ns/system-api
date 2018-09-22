
<div class="row">
  <div class="col-md-12">
    <div class="portlet box primary">
      <div class="portlet-title">
        <div class="caption">
           All Product
        </div>
      </div>
      <div class="portlet-body flip-scroll">
        <form action="/owner/product/by-name" method="GET" id="search">
          <div class="form-group input-group">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit" name="btnSubmit">
                <i class="fa fa-search"></i>
              </button>
            </span>
            <input type="text" name="name" id="name" class="form-control" placeholder="Search by name">
          </div>
        </form>
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Type</th>
            <th>Size</th>
            <th>Cost</th>
            <th>Price</th>
            <th>Time To Prepare</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($products as $product)
            <tr>
              <td>{{ $product['name'] }}</td>
              <td>{{ $product->productCategory['name'] }}</td>
              <td>{{ $product['type']  }}</td>
              <td>{{ $product['size']  }}</td>
              <td>{{ number_format($product['cost'], 2) }}</td>
              <td>{{ number_format($product['price'], 2) }}</td>
              <td>{{ $product['time_to_prepare'] }} min</td>
              <td>
                <a href="#"
                   onclick="return confirm('This will delete the product. Are you sure you want to proceed?')"
                   title="delete">
                 <i class="fa fa-fw fa-trash-o"></i>
                </a>
                <a href="#" title="edit">
                  <i class="fa fa-fw fa-pencil"></i>
                </a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>
  </div>
</div>