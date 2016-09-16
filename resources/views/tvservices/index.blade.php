@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
        <h1 class="pull-left">Tvservices</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('admin.tvservices.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @include('tvservices.table')
        
@endsection
