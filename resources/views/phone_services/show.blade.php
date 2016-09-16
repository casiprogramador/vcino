@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    @include('phone_services.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.phoneservices.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
