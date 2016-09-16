@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New Waterservice</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'admin.waterservices.store']) !!}

            @include('waterservices.fields')

        {!! Form::close() !!}
    </div>
@endsection
