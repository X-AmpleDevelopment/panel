@extends('layouts.admin')

@section('title')
    X-Ample Admin Dashboard
@endsection

@section('content-header')
    <h1>X-Ample Development Group</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@section('content')

{{-- User Info Overview --}}
<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border d-flex align-items-center">
                <i class="fa fa-user-circle fa-2x text-info mr-3"></i>
                <h3 class="box-title mb-0">Welcome, {{ auth()->user()->name }}</h3>
            </div>
            <div class="box-body" style="display: flex; flex-wrap: wrap; align-items: center;">
                <img 
                  src="https://i.imgur.com/4bSGPHi.png" 
                  alt="{{ auth()->user()->name }}'s Avatar" 
                  class="img-circle" 
                  style="width: 80px; height: 80px; margin-right: 20px; object-fit: cover;"
                />
                <div style="flex: 1; min-width: 220px;">
                    <p><strong>Email Address:</strong> 
                        <a href="mailto:{{ auth()->user()->email }}" class="text-info" aria-label="Send email to user">{{ auth()->user()->email }}</a>
                    </p>
                    <p><strong>Account Created On:</strong> 
                        <span title="{{ auth()->user()->created_at->toDayDateTimeString() }}">
                            {{ auth()->user()->created_at->format('F j, Y') }}
                        </span>
                    </p>
                    <p>
                        <strong>Last Login:</strong> 
                        @if(auth()->user()->last_login_at)
                            <span title="{{ auth()->user()->last_login_at->toDayDateTimeString() }}">
                                {{ auth()->user()->last_login_at->diffForHumans() }}
                            </span>
                        @else
                            Data not available..
                        @endif
                    </p>
                    @if(auth()->user()->roles && auth()->user()->roles->count() > 0)
                        <p>
                            <strong>Role{{ auth()->user()->roles->count() > 1 ? 's' : '' }}:</strong> 
                            @foreach(auth()->user()->roles as $role)
                                <span class="label label-info" style="margin-right: 6px; font-size: 12px; padding: 3px 8px;">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
            <div class="box-footer text-muted" style="font-size: 13px;">
                You are currently viewing the <strong>X-Ample Development Admin Dashboard</strong>. Use the sections below to manage your panel, monitor system status, get support, or contribute to our open source projects.
            </div>
        </div>
    </div>
</div>

{{-- System Overview --}}
<div class="row">
    <div class="col-xs-12">
        <div class="box {{ $version->isLatestPanel() ? 'box-success' : 'box-danger' }}">
            <div class="box-header with-border d-flex align-items-center">
                <i class="fa fa-server fa-lg mr-2"></i>
                <h3 class="box-title mb-0">X-Ample Panel Status</h3>
            </div>
            <div class="box-body">
                @if ($version->isLatestPanel())
                    <p>
                        <i class="fa fa-check-circle text-success"></i>
                        Your panel is running the <strong>latest version</strong>:
                        <code>{{ config('app.version') }}</code>. No updates required.
                    </p>
                    <p class="text-muted" style="margin-bottom: 1rem;">
                        Your system is up-to-date and secure. Keep an eye here for future updates!
                    </p>
                    {{-- Example extra info for uptime, add real data if available --}}
                    <p>
                        <strong>Panel Uptime:</strong> <span class="text-success">99.98%</span> (last 30 days)
                    </p>
                @else
                    <p>
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                        <strong>An update is available!</strong><br>
                        Installed Version: <code>{{ config('app.version') }}</code><br>
                        Latest Version: 
                        <a href="https://github.com/X-AmpleDevelopment/panel/releases/v{{ $version->getPanel() }}" target="_blank" rel="noopener noreferrer">
                            <code>{{ $version->getPanel() }}</code>
                        </a><br>
                        Please update as soon as possible to ensure optimal performance and security.
                    </p>
                    <p class="text-muted">
                        Check the <a href="https://github.com/X-AmpleDevelopment/panel/releases" target="_blank" rel="noopener noreferrer">release notes</a> for details.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row text-center" style="margin-top: 20px;">
    <div class="col-xs-6 col-sm-3">
        <a href="https://discord.gg/bGhguE93Xp" target="_blank" rel="noopener noreferrer">
            <button class="btn btn-warning btn-block" title="Join our Discord community for real-time support and discussion">
                <i class="fa fa-fw fa-comments fa-lg"></i> Discord Support<br>
                <small>Chat with the X-Ample community</small>
            </button>
        </a>
    </div>
    <div class="clearfix visible-xs-block"></div>
    <div class="col-xs-6 col-sm-3">
        <a href="https://github.com/X-AmpleDevelopment/panel" target="_blank" rel="noopener noreferrer">
            <button class="btn btn-info btn-block" title="Visit our GitHub repositories to contribute or browse the code">
                <i class="fa fa-fw fa-github fa-lg"></i> GitHub Repo<br>
                <small>Contribute or review code</small>
            </button>
        </a>
    </div>
    <div class="col-xs-6 col-sm-3">
        <a href="https://github.com/sponsors/XAmple-Development" target="_blank" rel="noopener noreferrer">
            <button class="btn btn-success btn-block" title="Support X-Ample Development with a donation">
                <i class="fa fa-fw fa-heart fa-lg"></i> Donate<br>
                <small>Support X-Ample Development</small>
            </button>
        </a>
    </div>
</div>

@endsection
