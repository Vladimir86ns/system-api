@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')
  Create New Product Category
  @parent
@stop

{{-- Page content --}}
@section('content')
  @include('owner.form.product.add')
@stop

