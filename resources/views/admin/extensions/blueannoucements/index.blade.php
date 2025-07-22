@extends('layouts.admin')
<?php 
    // Define extension information.
    $EXTENSION_ID = "blueannoucements";
    $EXTENSION_NAME = stripslashes("BlueAnnoucements");
    $EXTENSION_VERSION = "v1.2-stable";
    $EXTENSION_DESCRIPTION = stripslashes("A simple blueprint addon allowing you to display global alerts on your pterodactyl instance.");
    $EXTENSION_ICON = "/assets/extensions/blueannoucements/icon.png";
    $EXTENSION_WEBSITE = "https://macgould.xyz";
    $EXTENSION_WEBICON = "bx bx-link-external";
?>
@include('blueprint.admin.template')

@section('title')
    {{ $EXTENSION_NAME }}
@endsection

@section('content-header')
    @yield('extension.header')
@endsection

@section('content')
    @yield('extension.config')
    @yield('extension.description')<div class="row">
  <div class="col-lg-13 col-md-13 col-sm-12 col-xs-12">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">BlueAnnoucements Information <br><small>Key details about BlueAnnoucements.</small></h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12">
            <p>Name: <code>BLUEANNOUCEMENTS</code></p>
            <p>Identifier: <code>blueannoucements</code></p>
            <p>Author: <code>Spoopy4455</code></p>
            <p>Target Blueprint Build: <code>beta-2024-12</code></p>
            <p>Installation Type/Branch: <code>local</code></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form action="" method="POST">

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Should we display this alert? <br><small>This is enables you to show or hide alerts at any time.</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Select and option</label>
              <select class="form-control" name="status">
                <option value="true" @if($db_status == "true") selected @endif>Yes, display this alert</option>
                <option value="false" @if($db_status == "false") selected @endif>No, don't display this alert</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Is this alert able to be toggled? <br><small>This is optional, alerts will be created in a dismissible state by default.</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Select and option</label>
              <select class="form-control" name="hideable">
                <option value="true" @if($hideable == "true") selected @endif>Yes, this alert can be toggled</option>
                <option value="false" @if($hideable == "false") selected @endif>No, this alert can't be toggled</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Should this alert have an Icon? <br><small>This is enables you to show or hide the alert icon at any time.</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Select and option</label>
              <select class="form-control" name="icon">
                <option value="true" @if($icon == "true") selected @endif>Yes, enable the icon</option>
                <option value="false" @if($icon == "false") selected @endif>No, don't enable the icon</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Alert Text Colour <br><small>This is optional, text will default to white.</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Pick a colour</label>
                <input type="color" name="fontcolor" id="fontcolor" value="{{$fontcolor}}" placeholder="#606D7B" class="form-control"/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Alert Background Colour <br><small>This is optional, alerts will default to pastel green.</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Pick a colour</label>
                <input type="color" name="alertbodycolour" id="alertbodycolour" value="{{$alertbodycolour}}" placeholder="#606D7B" class="form-control"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Create your alert! <br><small>This is the fun bit :D</small></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <label class="control-label">Input</label>
              {{-- <textarea required name="text" id="text" rows="2" class="form-control" maxlength="9999">{{ $text }}</textarea> --}}
              <input type="text" required name="text" id="text" value="{{ $text }}" class="form-control"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xs-12">
      {{ csrf_field() }}
      <button type="submit" name="_method" value="PATCH" class="btn btn-success pull-right">Save changes & Publish</button>
    </div>
  </form> 
</div>
@endsection
