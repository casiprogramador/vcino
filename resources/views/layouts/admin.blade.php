@extends('layouts.app')
@section('body-class', 'fixed-nav skin-1')
@section('content')
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu nav-custom" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a href="{{ route('admin.home') }}">
                            <img src="{{ URL::asset('img/system/logo.png')}}" width="70" />
                        </a>
                    </div>
                    <div class="logo-element">
                        VCino
                    </div>
                </li>
                <li {!! (Request::is('communication/*') ? ' class="active"' : '') !!}>
                    <a href="index.html"><i class="fa fa-envelope-o"></i> <span
                                class="nav-label">Comunicación & Info</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Comunicados</a></li>
                        <li class="{{ MenuRoute::active('communication/phonesite') }}"><a href="{{ route('communication.phonesite.index') }}">Teléfonos y sitios útiles</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-building-o"></i> <span class="nav-label">Propiedades</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Propiedades</a></li>
                        <li><a href="#/">Contactos</a></li>
                    </ul>
                </li>

                <li {!! (Request::is('equipment/*') ? ' class="active"' : '') !!}>
                    <a href="index.html"><i class="fa fa-plug"></i> <span class="nav-label">Equipamiento</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ MenuRoute::active('equipment/machinery') }}"><a href="{{ route('equipment.machinery.index') }}">Equipos y maquinarias</a></li>
                    </ul>
                </li>

                <li {!! (Request::is('config/*') ? ' class="active"' : '') !!}>
                    <a href="index.html"><i class="fa fa-bar-chart"></i> <span class="nav-label">Configuración</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ MenuRoute::active('config/account') }}"><a href="{{ route('config.account.index') }}">Cuentas</a></li>
                        <li class="{{ MenuRoute::active('config/category') }}"><a href="{{ route('config.category.index') }}">Categorías</a></li>
                        <li class="{{ MenuRoute::active('config/supplier') }}"><a href="{{ route('config.supplier.index') }}">Proveedores</a></li>
                        <li class="{{ MenuRoute::active('config/installation') }}"><a href="{{ route('config.installation.index') }}">Instalaciones</a></li>
                        <li class="{{ MenuRoute::active('config/quota') }}"><a href="{{ route('config.quota.index') }}">Cuotas</a></li>
                        <li class="{{ MenuRoute::active('config/typeproperty') }}"><a href="{{ route('config.typeproperty.index') }}">Tipos de propiedad</a></li>
                        <li class="{{ MenuRoute::active('receiptnumbers') }}"><a href="{{ route('config.receiptnumber.index') }}">Número de comprobantes</a></li>
                        <li class="{{ MenuRoute::active('phonesite') }}"><a href="{{ route('config.phonesite.index') }}">Teléfonos y sitios útiles</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                    <div style="width:500px; margin-left:65px;">
                        <h2 style="margin-top:18px;">{{ Session::get('company_name') }}</h2>
                    </div>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i>Salir &nbsp;&raquo;&nbsp;
                            <span style="font-weight:normal; font-size: 13px; color: #CCC"> {{ Auth::user()->nombre }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('admin-content')
        <div class="footer">
            <div class="pull-right">
                v1.1
            </div>
            <div>
                <strong>Copyright</strong> Esfera &copy; 2016
            </div>
        </div>
    </div>
</div>
@endsection