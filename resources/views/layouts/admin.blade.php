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
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Administrador <b class="caret"></b></span> </span> </a>
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
                    <a href="index.html"><i class="fa fa-envelope-o"></i> <span class="nav-label">Comunicación & Info</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Comunicados</a></li>
                        <li><a href="#/">Teléfonos y sitios útiles</a></li>
                    </ul>
                </li>
                <li>
                    <a href="index.html"><i class="fa fa-building-o"></i> <span class="nav-label">Propiedades</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Propiedades</a></li>
                        <li><a href="#/">Contactos</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html"><i class="fa fa-plug"></i> <span class="nav-label">Equipamiento</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Equipos y maquinarias</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html"><i class="fa fa-bar-chart"></i> <span class="nav-label">Configuración</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#/">Cuentas</a></li>
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
    </div>