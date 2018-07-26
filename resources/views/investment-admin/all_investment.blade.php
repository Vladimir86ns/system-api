@extends('investment-admin/layouts/default')

{{-- Page title --}}
@section('title')
  All Investments
  @parent
@stop

{{-- Page content --}}
@section('content')
  @include('investment-admin.pages.all-investment.dashboard')

  <section class="content">
    @include('investment-admin.pages.all-investment.all_investment_table')

    @if ($transformedInvestment)
      @include('investment-admin.pages.all-investment.single_investment_table.blade')
    @endif

    @if ($editInvestment)
      @include('investment-admin.form.edit')
    @endif
  </section>
@stop
