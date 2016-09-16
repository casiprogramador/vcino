@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Waterservice</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($waterservice, ['route' => ['admin.waterservices.update', $waterservice->id], 'method' => 'patch']) !!}

            @include('waterservices.fields')

            {!! Form::close() !!}
        </div>
@endsection
