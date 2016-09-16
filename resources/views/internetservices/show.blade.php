@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    @include('internetservices.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.internetservices.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
