@extends('investment-admin/layouts/default')

{{-- Page title --}}
@section('title')
  Create investment
  @parent
@stop

{{-- Page content --}}
@section('content')
  @include('investment-admin.form.investment.create')
@stop

