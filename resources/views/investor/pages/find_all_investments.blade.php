@extends('investor.layouts.default')

{{-- Page title --}}
@section('title')
  All Investments
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
  <style>
    body{
      overflow: -webkit-paged-x;
    }
  </style>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
  <h1>Investments where you can invest</h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
        Dashboard
      </a>
    </li>
    <li class="active">All Investments</li>
  </ol>
</section>

{{-- DISPLAY ALL USER INVESTMENTS --}}
@include('investor.component.all-investments.all_investments_table')

{{-- DISPLAY SELECTED INVESTMENT --}}
{{-- @if($transformedInvestment)
  @include('investor.show.single.investition')
  @include('investor.show.single.chart')
@endIF --}}

@stop
