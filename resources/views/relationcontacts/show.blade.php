@extends('layouts.app')

@section('content')
    @include('relationcontacts.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.relationcontacts.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
