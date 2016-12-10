@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Imprimir aviso de cobranza</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li>
                Aviso de cobranza
            </li>
            <li class="active">
                <strong>Imprimir aviso de cobranza</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="#" class="btn btn-success">
            <i class="fa fa-print">&nbsp;&nbsp;&nbsp;</i>Imprimir aviso</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="border: 0;">
                                        <div class="p-h-xl"><img src="files/logoEmpresa.png" width="150"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom">
                                        <div class="p-h-xl text-right">
                                            <h2 style="line-height: 0;">AVISO DE COBRANZA</h2>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row" style="padding: 0 0 20px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <div class="row">
                        <table style="margin: 10px auto; text-align: left; width: 80%; font-size: 14px;">
                            <tr>
                                <td>
                                    <div class="row" style="padding: 0 0 40px 0;">
                                        <div class="col-sm-6">
                                            Propiedad:&nbsp;&nbsp;<span><strong>Cupesi 12</strong></span>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            Al periodo:&nbsp;&nbsp;<span><strong>Octubre 2016</strong></span>
                                        </div>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tr>
                                            <td style="border-top: #eee 1px solid; padding: 5px 0;">Expensas: cuota mensual - Septiembre/ 2016</td>
                                            <td style="border-top: #eee 1px solid; text-align: right; padding: 5px 0;">900,00</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top: #eee 1px solid; padding: 5px 0;">Servicio de agua potable</td>
                                            <td style="border-top: #eee 1px solid; text-align: right; padding: 5px 0;">46,00</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top: #eee 1px solid; padding: 5px 0;">Expensas: cuota mensual - Agosto/ 2016</td>
                                            <td style="border-top: #eee 1px solid; text-align: right; padding: 5px 0;">900,00</td>
                                        </tr>
                                        <tr style="font-size: 16px;">
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total</td>
                                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 5px 0;">Bs. 1.846,00</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row" style="padding: 20px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <table style="margin: auto; text-align: left; width: 80%; font-size: 11px;">
                        <tr>
                            <td>
                                <address style="color: #9ba3a9;">
                                    <strong>Forma de pago</strong>
                                    <ul>
                                        <li>Efectivo (oficinas - Lunes a viernes de 08:30 a 12:30)</li>
                                        <li>Depósito o transferencia bancaria:
                                            <ul>
                                                <li>Banco BISA S.A.</li>
                                                <li>Cuenta Corriente en Bolivianos</li>
                                                <li>No. 022125-001-0</li>
                                                <li>A nombre de:<br/>
                                                    - Lily Arandia de Rocha, CI 3187412 SC<br/>
                                                    - Saul Torres Sanchez, CI 2336407 LP</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </address>

                                <address style="color: #9ba3a9;">
                                    <strong>Nota</strong>
                                    <p>Para pagos realizados a través del banco, favor enviar comprobante por correo electrónico.</p>
                                </address>
                            </td>
                        </tr>
                    </table>

                    <div class="row" style="padding: 10px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">Consultas o comentarios: <a href="mailto:">fragatatower@gmail.com</a>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection