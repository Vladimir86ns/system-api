@extends('investment-admin/layouts/default')

{{-- Page title --}}
@section('title')
  Confirm Investment
@parent
@stop

{{-- Page content --}}
@section('content')
  @include('investment-admin.component.all-investment.dashboard')
  @include('investment-admin.component.all-investment.all_investment_table')

  @if ($editInvestment)
    @include('investment-admin.form.investment.confirm')
  @endif
@stop
