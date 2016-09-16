@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    @include('electricservices.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.electricservices.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
