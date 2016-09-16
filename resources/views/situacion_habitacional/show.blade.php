@extends('layouts.app')
@section('body-class', 'gray-bg')

@section('content')
<div class="container">
    @include('situacion_habitacional.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.situacionHabitacional.index') !!}" class="btn btn-default">Back</a>
    </div>
</div>
@endsection
