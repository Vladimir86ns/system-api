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
  <h1>All Your Investments</h1>
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
@include('investor.component.user-all-investments.user_all_investments_table')

@stop
