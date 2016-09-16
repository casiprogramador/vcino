@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Tvservice</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($tvservice, ['route' => ['admin.tvservices.update', $tvservice->id], 'method' => 'patch']) !!}

            @include('tvservices.fields')

            {!! Form::close() !!}
        </div>
@endsection
