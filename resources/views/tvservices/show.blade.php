@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    @include('tvservices.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.tvservices.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
