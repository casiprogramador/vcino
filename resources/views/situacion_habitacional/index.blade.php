@extends('layouts.app')
@section('body-class', 'gray-bg')

@section('content')
<div class="container">


        <h1 class="pull-left">Situacion Habitacional</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('admin.situacionHabitacional.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @include('situacion_habitacional.table')
</div>        
@endsection
