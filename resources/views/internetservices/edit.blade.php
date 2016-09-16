@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Internetservice</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($internetservice, ['route' => ['admin.internetservices.update', $internetservice->id], 'method' => 'patch']) !!}

            @include('internetservices.fields')

            {!! Form::close() !!}
        </div>
@endsection
