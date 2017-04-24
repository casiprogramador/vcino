@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <table style="margin: 0 auto; width: 90%; padding-top: 10px;">
                            <tbody>
                                <tr>
                                    <td style="border: 0; width: 50%; padding-right: 20px;">
                                        <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="{{Auth::user()->company->width_logo}}"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom;">
                                        <div class="p-h-xl text-right">
                                            <h2 style="line-height: 16px; text-align: right;">COMUNICADO</h2>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <table style="margin: 10px auto; text-align: left; width: 90%; font-size: 14px;">
                            <tr>
                                <td>
                                    <div class="row" style="padding: 10px 0 20px 0;">
                                        <div class="col-sm-6" style="padding-bottom: 10px;">
                                            Fecha:&nbsp;&nbsp;&nbsp;{{ date_format(date_create($communication->fecha),'d/m/Y') }}
                                        </div>
                                        <div class="col-sm-6">
                                            Asunto:&nbsp;<span><strong>{{ $communication->asunto }}</strong></span>
                                        </div>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr>
                                <td>									
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tr>
                                            <td style="border-top: #eee 1px solid; padding: 5px 0;">
                                            	<?php echo $comunicado_cuerpo ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
