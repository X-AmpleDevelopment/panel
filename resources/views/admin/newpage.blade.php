@extends('layouts.admin')

@section('title')
    X-Ample | Admin Hub
@endsection

@section('content-header')
    <h1><i class="fa fa-rocket"></i> X-Ample Admin Hub</h1>
    <small>Welcome to the internal admin dashboard</small>
@endsection

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Users Tab</h3>
                <p>Manage all users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.users') }}" class="small-box-footer">
                Manage Users <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>Servers Tab</h3>
                <p>Manage all servers</p>
            </div>
            <div class="icon">
                <i class="fa fa-gamepad"></i>
            </div>
            <a href="{{ route('admin.servers') }}" class="small-box-footer">
                View Servers <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>Nodes Tab</h3>
                <p>Manage all nodes</p>
            </div>
            <div class="icon">
                <i class="fa fa-hdd-o"></i>
            </div>
            <a href="{{ route('admin.nodes') }}" class="small-box-footer">
                View Nodes <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- About Panel -->
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> About This Panel</h3>
            </div>
            <div class="box-body">
                <p><strong>X-Ample Development</strong> provides customized Pterodactyl experiences for our own servers/services</p>
                <p>This dashboard acts as a control hub for viewing key metrics and accessing tools across your network.</p>
                <hr>
                <ul>
                    <li>Built on <strong>Laravel {{ app()->version() }}</strong></li>
                    <li>Theme: <strong>Nebula Premium</strong></li>
                    <li>Base: <strong>Blueprint Framework</strong></li>
                    <li>PHP Version: <strong>{{ phpversion() }}</strong></li>
                    <li>Developed By: <strong>X-Ample Development</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bolt"></i> Quick Actions</h3>
            </div>
            <div class="box-body">
                <a href="https://github.com/X-AmpleDevelopment/panel" class="btn btn-primary btn-block" target="_blank">
                    <i class="fa fa-github"></i> GitHub Repo
                </a>
                <a href="https://builtbybit.com/resources/nebula.32442/" class="btn btn-info btn-block" target="_blank">
                    <i class="fa fa-star"></i> Nebula Theme
                </a>
                <a href="https://blueprint.zip/" class="btn btn-default btn-block" target="_blank">
                    <i class="fa fa-cube"></i> Blueprint Docs
                </a>
		<a href="https://discord.gg/bGhguE93Xp" class="btn btn-default btn-block" target="_blank">
                    <i class="fa fa-circle"></i> Community Discord
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
