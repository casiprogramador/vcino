@extends('layouts.app')

@section('content')
    @include('media.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.media.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
