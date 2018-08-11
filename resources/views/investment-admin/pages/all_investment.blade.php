@extends('investment-admin/layouts/default')

{{-- Page title --}}
@section('title')
  All Investments
  @parent
@stop

{{-- Page content --}}
@section('content')
  @include('investment-admin.component.all-investment.dashboard')

  <section class="content">
    @include('investment-admin.component.all-investment.all_investment_table')

    @if ($transformedInvestment)
      @include('investment-admin.component.all-investment.single_investment_table')
    @endif

    @if ($editInvestment)
      @include('investment-admin.form.investment.edit')
    @endif
  </section>
@stop
