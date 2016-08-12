@extends('layouts.app')
@section('body-class', '')
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>

                                 </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong
                                                class="font-bold">{{ Auth::user()->nombre }}</strong>
                                 </span> <span class="text-muted text-xs block">Administrador <b
                                                class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-envelope-o"></i> <span
                                class="nav-label">Comunicación & Info</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Comunicados</a></li>
                        <li><a href="#/">Teléfonos y sitios útiles</a></li>
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

                <li>
                    <a href="index.html"><i class="fa fa-plug"></i> <span class="nav-label">Equipamiento</span> <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Equipos y maquinarias</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html"><i class="fa fa-bar-chart"></i> <span class="nav-label">Configuración</span>
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('account.index') }}">Cuentas</a></li>
                        <li><a href="#/">Categorías</a></li>
                        <li><a href="#/">Proveedores</a></li>
                        <li><a href="#/">Instalaciones</a></li>
                        <li><a href="#/">Cuotas</a></li>
                        <li><a href="#/">Tipos de propiedad</a></li>
                        <li><a href="#/">Número de comprobantes</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="profile.html" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>.
                                        <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                        </ul>
                    </li>


                    <li>
                        <a href="login.html">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('admin-content')
    </div>
</div>
