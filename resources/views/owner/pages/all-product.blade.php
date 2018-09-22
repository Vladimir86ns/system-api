@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')
  Add new Employees
  @parent
@stop

{{-- Page content --}}
@section('content')
  @include('owner.table.product.all-product-table')
@stop

