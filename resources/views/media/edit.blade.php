@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Media</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($media, ['route' => ['admin.media.update', $media->id], 'method' => 'patch']) !!}

            @include('media.fields')

            {!! Form::close() !!}
        </div>
@endsection
