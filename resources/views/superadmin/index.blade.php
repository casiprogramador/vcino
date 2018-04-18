@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Elige una empresa</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/administrator/home') }}">
                            {{ csrf_field() }}

                           
							<div class="form-group{{ $errors->has('dias_mora') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Empresa</label>

                                <div class="col-md-6">
									{{ Form::select('company',$companies, old('company'), ['class' => 'form-control input-sm']) }}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-btn fa-user"></i> Ingresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
               ]
            });
        });
    </script>
@endsection