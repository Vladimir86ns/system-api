@extends('owner/layouts/default')

{{-- Page title --}}
@section('title')
  Add new Employees
  @parent
@stop

{{-- Page content --}}
@section('content')
  @if(count($employees) > 0)
    @include('owner.table.employees.add-employee-table')
  @else
    <h3>There is no employees for hearing...</h3>
  @endif
@stop

