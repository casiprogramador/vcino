@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Typecontact</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($typecontact, ['route' => ['admin.typecontacts.update', $typecontact->id], 'method' => 'patch']) !!}

            @include('typecontacts.fields')

            {!! Form::close() !!}
        </div>
@endsection
