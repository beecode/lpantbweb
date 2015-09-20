@extends('layout.lteadmin.index')
@section('content')
<aside class="right-side">
    <section class="content-header">
        <h1>
            {{$page_title}}
            <small>{{$panel_title}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-edit"></i> Kasus Anak</a></li>
            <li><a href="#"><i class="fa fa-th-list"></i> KA1</a></li>
            <li><a href="#"><i class="fa fa-table"></i> {{$panel_title}}</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      @if (Session::has('message'))
      <div class="alert alert-<?php echo Session::get('alert'); ?> alert-dismissable">
          <i class="fa fa-warning"></i>
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          {{ Session::get('message') }}
      </div>
      @endif
        @include('dashboard.chart.filter')
        @include('dashboard.chart.usia')
        @include('dashboard.chart.pendidikan')
        @include('dashboard.chart.lokasi')
        @include('dashboard.chart.jenis')
    </section>
</aside>
@stop
