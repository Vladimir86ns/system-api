@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')
  Add new Employees
  @parent
@stop

{{-- Page content --}}
@section('content')

  @if (isset($selectedProduct))
    @include('owner.form.product.edit')
  @else
    @include('owner.table.product.all-product-table')
  @endif

@stop

