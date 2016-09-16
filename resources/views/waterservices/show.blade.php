@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    @include('waterservices.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.waterservices.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
