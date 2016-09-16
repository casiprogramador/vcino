@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Phone Service</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($phoneService, ['route' => ['admin.phoneservices.update', $phoneService->id], 'method' => 'patch']) !!}

            @include('phone_services.fields')

            {!! Form::close() !!}
        </div>
@endsection
