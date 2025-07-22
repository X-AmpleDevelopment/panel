@extends('layouts.admin')
<?php 
    // Define extension information.
    $EXTENSION_ID = "lyrdyannounce";
    $EXTENSION_NAME = stripslashes("Announce");
    $EXTENSION_VERSION = "1.0";
    $EXTENSION_DESCRIPTION = stripslashes("Layeredy Announce integration for Pterodactyl/Blueprint");
    $EXTENSION_ICON = "/assets/extensions/lyrdyannounce/icon.png";
    $EXTENSION_WEBSITE = "https://layeredy.com/announce";
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
    @yield('extension.description')<form id="config-form" action="" method="POST">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
      <img src="/extensions/lyrdyannounce/wordmark.png" style="width: 100%; filter: brightness(0) invert(1)"/>
      <br>
      This extension is an integration for <b>Layeredy Announce</b>. To utilize Announce, <a href="https://announce.layeredy.com/" target="_blank">make an account here</a>.
        <br />
        <p class="text-muted small">Copyright &copy; 2025 Layeredy Software</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <i class="bi bi-toggles"></i>
            Toggle
          </h3>
        </div>
        <div class="box-body">
          <div class="col-xs-12">
            <label class="control-label text-truncate">
              Enable/disable Announce
            </label>

            <select class="form-control" name="enable">
              <option value="true" @if($toggle == "true") selected @endif>Enabled</option>
              <option value="false" @if($toggle == "false") selected @endif>Disabled</option>
            </select>
            <p class="text-muted small">
              Enable or disable Announce. If disabled, the Announce script will not be loaded on your site.
            </p>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <i class="bi bi-tags-fill"></i>
            Your Identifier
          </h3>
        </div>
        <div class="box-body">
          <div class="col-xs-12">
            <label class="control-label text-truncate">
              Identifier
            </label>

            <input type="text" name="user_id" id="user_id" value="{{ $user_id }}" placeholder="usr_test_1234567890" class="form-control"/>

            <p class="text-muted small">
              Your identifier (You'll need an <a href="https://announce.layeredy.com/" target="_blank">Announce</a> account)
            </p>
          </div>
        </div>
      </div>
      <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm">Apply Changes</button>
      {{ csrf_field() }}
    </div>
  </div>
</form>
@endsection
