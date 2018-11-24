@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')
  All Employees
  @parent
@stop

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


{{-- Page content --}}
@section('content')
  @include('owner.table.employees.all-employee-table')




@stop


