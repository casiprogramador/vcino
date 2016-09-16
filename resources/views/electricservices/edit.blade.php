@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Electricservice</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($electricservice, ['route' => ['admin.electricservices.update', $electricservice->id], 'method' => 'patch']) !!}

            @include('electricservices.fields')

            {!! Form::close() !!}
        </div>
@endsection
