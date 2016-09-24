@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Relationcontact</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($relationcontact, ['route' => ['admin.relationcontacts.update', $relationcontact->id], 'method' => 'patch']) !!}

            @include('relationcontacts.fields')

            {!! Form::close() !!}
        </div>
@endsection
