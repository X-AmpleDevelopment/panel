<?php
  $n_sidebar_home = $blueprint->dbGet("nebula", "sidebar_home");
  $n_sidebar_admin = $blueprint->dbGet("nebula", "sidebar_admin");
  $n_sidebar_account = $blueprint->dbGet("nebula", "sidebar_account");
  $n_sidebar_logout = $blueprint->dbGet("nebula", "sidebar_logout");
  $n_sidebar_server_terminal = $blueprint->dbGet("nebula", "sidebar_server_terminal");
  $n_sidebar_server_files = $blueprint->dbGet("nebula", "sidebar_server_files");
  $n_sidebar_server_databases = $blueprint->dbGet("nebula", "sidebar_server_databases");
  $n_sidebar_server_schedules = $blueprint->dbGet("nebula", "sidebar_server_schedules");
  $n_sidebar_server_users = $blueprint->dbGet("nebula", "sidebar_server_users");
  $n_sidebar_server_backups = $blueprint->dbGet("nebula", "sidebar_server_backups");
  $n_sidebar_server_network = $blueprint->dbGet("nebula", "sidebar_server_network");
  $n_sidebar_server_startup = $blueprint->dbGet("nebula", "sidebar_server_startup");
  $n_sidebar_server_settings = $blueprint->dbGet("nebula", "sidebar_server_settings");
  $n_sidebar_server_activity = $blueprint->dbGet("nebula", "sidebar_server_activity");
  $n_sidebar_server_more = $blueprint->dbGet("nebula", "sidebar_server_more");
  $n_sidebar_account_account = $blueprint->dbGet('nebula', 'sidebar_account_account');
  $n_sidebar_account_api = $blueprint->dbGet('nebula', 'sidebar_account_api');
  $n_sidebar_account_ssh = $blueprint->dbGet('nebula', 'sidebar_account_ssh');
  $n_sidebar_account_activity = $blueprint->dbGet('nebula', 'sidebar_account_activity');
  $n_sidebar_account_more = $blueprint->dbGet('nebula', 'sidebar_account_more');
  $n_icon_scale = $blueprint->dbGet("nebula", "icon_scale");
  $n_watermark = $blueprint->dbGet("nebula", "watermark");
  $n_init = $blueprint->dbGet("nebula", "init");
  $n_background_image = $blueprint->dbGet("nebula", "background_image");
  $n_sidebar_background = $blueprint->dbGet("nebula", "sidebar_background");
  $n_content_background = $blueprint->dbGet("nebula", "content_background");
  $n_background_appearance = $blueprint->dbGet("nebula", "background_appearance");
  $n_background_magic = $blueprint->dbGet("nebula", "background_magic");
  $n_background_magicsize = $blueprint->dbGet("nebula", "background_magicsize");
  $n_auth_background_image = $blueprint->dbGet("nebula", "auth_background_image");
  $n_auth_background_appearance = $blueprint->dbGet("nebula", "auth_background_appearance");
  $n_auth_background_magic = $blueprint->dbGet("nebula", "auth_background_magic");
  $n_auth_background_magicsize = $blueprint->dbGet("nebula", "auth_background_magicsize");
  $n_palette_dashboard_1 = $blueprint->dbGet("nebula", "palette_dashboard_1");
  $n_palette_dashboard_2 = $blueprint->dbGet("nebula", "palette_dashboard_2");
  $n_palette_dashboard_3 = $blueprint->dbGet("nebula", "palette_dashboard_3");
  $n_palette_dashboard_4 = $blueprint->dbGet("nebula", "palette_dashboard_4");
  $n_palette_dashboard_5 = $blueprint->dbGet("nebula", "palette_dashboard_5");
  $n_palette_dashboard_6 = $blueprint->dbGet("nebula", "palette_dashboard_6");
  $n_palette_dashboard_7 = $blueprint->dbGet("nebula", "palette_dashboard_7");
  $n_palette_dashboard_8 = $blueprint->dbGet("nebula", "palette_dashboard_8");
  $n_palette_dashboard_9 = $blueprint->dbGet("nebula", "palette_dashboard_9");
  $n_palette_sidebar_1 = $blueprint->dbGet("nebula", "palette_sidebar_1");
  $n_palette_sidebar_2 = $blueprint->dbGet("nebula", "palette_sidebar_2");
  $n_palette_sidebar_3 = $blueprint->dbGet("nebula", "palette_sidebar_3");
  $n_palette_sidebar_4 = $blueprint->dbGet("nebula", "palette_sidebar_4");
  $n_palette_sidebar_5 = $blueprint->dbGet("nebula", "palette_sidebar_5");
  $n_palette_sidebar_6 = $blueprint->dbGet("nebula", "palette_sidebar_6");
  $n_palette_sidebar_7 = $blueprint->dbGet("nebula", "palette_sidebar_7");
  $n_palette_sidebar_8 = $blueprint->dbGet("nebula", "palette_sidebar_8");
  $n_palette_auth_1 = $blueprint->dbGet("nebula", "palette_auth_1");
  $n_palette_auth_2 = $blueprint->dbGet("nebula", "palette_auth_2");
  $n_palette_auth_3 = $blueprint->dbGet("nebula", "palette_auth_3");
  $n_palette_auth_4 = $blueprint->dbGet("nebula", "palette_auth_4");
  $n_palette_auth_5 = $blueprint->dbGet("nebula", "palette_auth_5");
  $n_palette_auth_6 = $blueprint->dbGet("nebula", "palette_auth_6");
  $n_palette_auth_7 = $blueprint->dbGet("nebula", "palette_auth_7");
  $n_palette_auth_8 = $blueprint->dbGet("nebula", "palette_auth_8");
  $n_keyboard_shortcuts = $blueprint->dbGet("nebula", "keyboard_shortcuts");
  $n_keybind_icons = $blueprint->dbGet("nebula", "keybind_icons");
  $n_sidebar_hover_tooltip = $blueprint->dbGet("nebula", "sidebar_hover_tooltip");
  $n_server_overview_graphs = $blueprint->dbGet("nebula", "server_overview_graphs");
  $n_server_colored_power = $blueprint->dbGet("nebula", "server_colored_power");
  $n_sidebar_always_visible_buttons = $blueprint->dbGet("nebula", "sidebar_always_visible_buttons");
  $n_icon_fallback = $blueprint->dbGet("nebula", "icon_fallback");
  $n_dashboard_transparency = $blueprint->dbGet("nebula", "dashboard_transparency");
  $n_page_indexing = $blueprint->dbGet("nebula", "page_indexing");
  $n_website_links = $blueprint->dbGet("nebula", "website_links");
  $n_weblink_support = $blueprint->dbGet("nebula", "weblink_support");
  $n_weblink_billing = $blueprint->dbGet("nebula", "weblink_billing");
  $n_weblink_status = $blueprint->dbGet("nebula", "weblink_status");
  $n_weblink_social_discord = $blueprint->dbGet("nebula", "weblink_social_discord");
  $n_weblink_social_github = $blueprint->dbGet("nebula", "weblink_social_github");
  $n_website_links_align = $blueprint->dbGet("nebula", "website_links_align");
  $n_alert = $blueprint->dbGet("nebula", "alert");
  $n_alert_text = $blueprint->dbGet("nebula", "alert_text");
  $n_alert_icon = $blueprint->dbGet("nebula", "alert_icon");
  $n_watermark_auth = $blueprint->dbGet("nebula", "watermark_auth");
  $n_server_list = $blueprint->dbGet("nebula", "server_list");
  $n_reset = $blueprint->dbGet("nebula", "reset");
  $n_border_radius = $blueprint->dbGet("nebula", "border_radius");
  $n_sidebar_full = $blueprint->dbGet("nebula", "sidebar_full");
  $n_sidebar_buttonstyle = $blueprint->dbGet("nebula", "sidebar_buttonstyle");
  $n_sidebar_customlogo = $blueprint->dbGet("nebula", "sidebar_customlogo");
  $n_auth_customlogo = $blueprint->dbGet("nebula", "auth_customlogo");
  $n_alert_position = $blueprint->dbGet("nebula", "alert_position");
  $n_sidebar_border_radius = $blueprint->dbGet("nebula", "sidebar_border_radius");
  $n_alert_dismiss = $blueprint->dbGet("nebula", "alert_dismiss");
  $n_palette_status_offline = $blueprint->dbGet("nebula", "palette_status_offline");
  $n_palette_status_error = $blueprint->dbGet("nebula", "palette_status_error");
  $n_palette_status_starting = $blueprint->dbGet("nebula", "palette_status_starting");
  $n_palette_status_online = $blueprint->dbGet("nebula", "palette_status_online");
  $n_statusgradient_style = $blueprint->dbGet("nebula", "statusgradient_style");
  $n_sidebar_hover = $blueprint->dbGet("nebula", "sidebar_hover");
  $n_animations = $blueprint->dbGet("nebula", "animations");
  $n_sidebar_separators = $blueprint->dbGet("nebula", "sidebar_separators");
?>
@include('blueprint.extensions.nebula.wrapper.import')
  
@if($n_init == "2.0-1")
  
@include('blueprint.extensions.nebula.wrapper.links')
@include('blueprint.extensions.nebula.wrapper.alerts')
@include('blueprint.extensions.nebula.wrapper.theme.icons')

@if(Auth::check())
@if($n_watermark == "1")
<p class="nebulaFooter"><a href="https://nebula.style/" class="nebulaFooter"><i style="font-size:12px; margin-right: 3px;" class="bi bi-exclude"></i> Powered by Nebula.</a></p>
@endif
<div
  <?php
    if($n_background_magic != "") {
      echo('class="fixed-pattern-background magic-pattern['.$n_background_magic.']" view="dashboard"');
    } else {
      echo('class="fixed-background"');
    }
    ?>
></div>
<div id="sidebar" class="sidebar">
  <?php 
    $__WIDE_TOPMARGIN = "unset";
    if($n_icon_fallback == "bootstrap") {

      // BOOTSTRAP
      $__SCALE = "30px";
      $__WIDE_TOPMARGIN = "unset";
      $__home             = "bi bi-exclude";
      $__admin            = "bi bi-gear-wide-connected";
      $__account          = "bi bi-person-fill-gear";
      $__logout           = "bi bi-box-arrow-right";
      $__server_terminal  = "bi bi-terminal";
      $__server_files     = "bi bi-folder2";
      $__server_databases = "bi bi-database";
      $__server_schedules = "bi bi-calendar-week";
      $__server_users     = "bi bi-people";
      $__server_backups   = "bi bi-disc";
      $__server_network   = "bi bi-hdd-network";
      $__server_startup   = "bi bi-plug";
      $__server_settings  = "bi bi-gear";
      $__server_activity  = "bi bi-clipboard-pulse";
      $__server_more      = "bi bi-three-dots";
      $__account_account  = "bi bi-person-badge";
      $__account_api      = "bi bi-braces-asterisk";
      $__account_ssh      = "bi bi-key";
      $__account_activity = "bi bi-clipboard-pulse";
      $__account_more     = "bi bi-three-dots";

    } elseif($n_icon_fallback == "feather") {

      // FEATHER
      $__SCALE = "32px";
      $__WIDE_TOPMARGIN = "-2px";
      $__home             = "ff ff-home";
      $__admin            = "ff ff-sliders";
      $__account          = "ff ff-user";
      $__logout           = "ff ff-log-out";
      $__server_terminal  = "ff ff-terminal";
      $__server_files     = "ff ff-folder";
      $__server_databases = "ff ff-database";
      $__server_schedules = "ff ff-calendar";
      $__server_users     = "ff ff-users";
      $__server_backups   = "ff ff-disc";
      $__server_network   = "ff ff-globe";
      $__server_startup   = "ff ff-hard-drive";
      $__server_settings  = "ff ff-settings";
      $__server_activity  = "ff ff-activity";
      $__server_more      = "ff ff-more-vertical";
      $__account_account  = "ff ff-settings";
      $__account_api      = "ff ff-link";
      $__account_ssh      = "ff ff-key";
      $__account_activity = "ff ff-activity";
      $__account_more     = "ff ff-more-vertical";

    } elseif($n_icon_fallback == "lucide") {

      // LUCIDE
      $__SCALE = "32px";
      $__home             = "icon-layers";
      $__admin            = "icon-sliders-horizontal";
      $__account          = "icon-user";
      $__logout           = "icon-log-out";
      $__server_terminal  = "icon-terminal-square";
      $__server_files     = "icon-folder-open";
      $__server_databases = "icon-database";
      $__server_schedules = "icon-calendar-clock";
      $__server_users     = "icon-users";
      $__server_backups   = "icon-archive";
      $__server_network   = "icon-network";
      $__server_startup   = "icon-unplug";
      $__server_settings  = "icon-settings";
      $__server_activity  = "icon-scroll-text";
      $__server_more      = "icon-more-vertical";
      $__account_account  = "icon-settings";
      $__account_api      = "icon-globe";
      $__account_ssh      = "icon-key";
      $__account_activity = "icon-scroll-text";
      $__account_more     = "icon-more-vertical";

    } elseif($n_icon_fallback == "material") {

      // MATERIAL
      $__SCALE = "37px";
      $__home             = "mdi mdi-home";
      $__admin            = "mdi mdi-hammer-wrench";
      $__account          = "mdi mdi-account-edit";
      $__logout           = "mdi mdi-logout";
      $__server_terminal  = "mdi mdi-console-line";
      $__server_files     = "mdi mdi-folder";
      $__server_databases = "mdi mdi-database";
      $__server_schedules = "mdi mdi-calendar-month";
      $__server_users     = "mdi mdi-account-group";
      $__server_backups   = "mdi mdi-backup-restore";
      $__server_network   = "mdi mdi-network";
      $__server_startup   = "mdi mdi-cog-play";
      $__server_settings  = "mdi mdi-wrench-cog";
      $__server_activity  = "mdi mdi-clipboard-pulse";
      $__server_more      = "mdi mdi-dots-horizontal";
      $__account_account  = "mdi mdi-account-cog";
      $__account_api      = "mdi mdi-code-brackets";
      $__account_ssh      = "mdi mdi-key-chain";
      $__account_activity = "mdi mdi-clipboard-pulse";
      $__account_more     = "mdi mdi-dots-horizontal";

    } elseif($n_icon_fallback == "material-light") {

      // MATERIAL-LIGHT
      $__SCALE = "37px";
      $__home             = "mdil mdil-home";
      $__admin            = "mdil mdil-view-dashboard";
      $__account          = "mdil mdil-account";
      $__logout           = "mdil mdil-logout";
      $__server_terminal  = "mdil mdil-console";
      $__server_files     = "mdil mdil-folder";
      $__server_databases = "mdil mdil-table";
      $__server_schedules = "mdil mdil-calendar";
      $__server_users     = "mdil mdil-eye";
      $__server_backups   = "mdil mdil-content-duplicate";
      $__server_network   = "mdil mdil-sitemap";
      $__server_startup   = "mdil mdil-pencil";
      $__server_settings  = "mdil mdil-settings";
      $__server_activity  = "mdil mdil-clipboard-text";
      $__server_more      = "mdil mdil-dots-horizontal";
      $__account_account  = "mdil mdil-settings";
      $__account_api      = "mdil mdil-link";
      $__account_ssh      = "mdil mdil-lock";
      $__account_activity = "mdil mdil-clipboard-text";
      $__account_more     = "mdil mdil-dots-horizontal";

    } elseif($n_icon_fallback == "fontawesome") {

      // FONTAWESOME
      $__SCALE = "28px";
      $__home             = "fa-solid fa-house";
      $__admin            = "fa-solid fa-sliders";
      $__account          = "fa-solid fa-user-gear";
      $__logout           = "fa-solid fa-right-from-bracket";
      $__server_terminal  = "fa-solid fa-bars-progress";
      $__server_files     = "fa-solid fa-folder";
      $__server_databases = "fa-solid fa-database";
      $__server_schedules = "fa-solid fa-calendar";
      $__server_users     = "fa-solid fa-user-group";
      $__server_backups   = "fa-solid fa-box-archive";
      $__server_network   = "fa-solid fa-network-wired";
      $__server_startup   = "fa-solid fa-wrench";
      $__server_settings  = "fa-solid fa-gear";
      $__server_activity  = "fa-solid fa-scroll";
      $__server_more      = "fa-solid fa-ellipsis-vertical";
      $__account_account  = "fa-solid fa-circle-user";
      $__account_api      = "fa-solid fa-globe";
      $__account_ssh      = "fa-solid fa-key";
      $__account_activity = "fa-solid fa-scroll";
      $__account_more     = "fa-solid fa-ellipsis-vertical";

    } elseif($n_icon_fallback == "eva-outline") {

      // EVA OUTLINE
      $__SCALE = "34px";
      $__home             = "eva eva-home-outline";
      $__admin            = "eva eva-options-outline";
      $__account          = "eva eva-person-outline";
      $__logout           = "eva eva-log-out-outline";
      $__server_terminal  = "eva eva-hard-drive-outline";
      $__server_files     = "eva eva-folder-outline";
      $__server_databases = "eva eva-cube-outline";
      $__server_schedules = "eva eva-calendar-outline";
      $__server_users     = "eva eva-people-outline";
      $__server_backups   = "eva eva-archive-outline";
      $__server_network   = "eva eva-wifi-outline";
      $__server_startup   = "eva eva-flash-outline";
      $__server_settings  = "eva eva-settings-outline";
      $__server_activity  = "eva eva-activity-outline";
      $__server_more      = "eva eva-more-horizontal-outline";
      $__account_account  = "eva eva-settings-outline";
      $__account_api      = "eva eva-globe-outline";
      $__account_ssh      = "eva eva-lock-outline";
      $__account_activity = "eva eva-activity-outline";
      $__account_more     = "eva eva-more-horizontal-outline";

    } elseif($n_icon_fallback == "eva-solid") {

      // EVA SOLID
      $__SCALE = "34px";
      $__home             = "eva eva-home";
      $__admin            = "eva eva-options";
      $__account          = "eva eva-person";
      $__logout           = "eva eva-log-out";
      $__server_terminal  = "eva eva-hard-drive";
      $__server_files     = "eva eva-folder";
      $__server_databases = "eva eva-cube";
      $__server_schedules = "eva eva-calendar";
      $__server_users     = "eva eva-people";
      $__server_backups   = "eva eva-archive";
      $__server_network   = "eva eva-wifi";
      $__server_startup   = "eva eva-flash";
      $__server_settings  = "eva eva-settings";
      $__server_activity  = "eva eva-activity";
      $__server_more      = "eva eva-more-horizontal";
      $__account_account  = "eva eva-settings";
      $__account_api      = "eva eva-globe";
      $__account_ssh      = "eva eva-lock";
      $__account_activity = "eva eva-activity";
      $__account_more     = "eva eva-more-horizontal";

    } elseif($n_icon_fallback == "remix-outline") {

      // REMIX OUTLINE
      $__SCALE = "33px";
      $__home             = "ri-home-line";
      $__admin            = "ri-equalizer-3-line";
      $__account          = "ri-user-settings-line";
      $__logout           = "ri-logout-box-r-line";
      $__server_terminal  = "ri-terminal-box-line";
      $__server_files     = "ri-folder-6-line";
      $__server_databases = "ri-database-2-line";
      $__server_schedules = "ri-calendar-line";
      $__server_users     = "ri-group-line";
      $__server_backups   = "ri-archive-line";
      $__server_network   = "ri-arrow-up-down-line";
      $__server_startup   = "ri-edit-box-line";
      $__server_settings  = "ri-settings-line";
      $__server_activity  = "ri-pulse-line";
      $__server_more      = "ri-more-2-line";
      $__account_account  = "ri-settings-line";
      $__account_api      = "ri-global-line";
      $__account_ssh      = "ri-key-2-line";
      $__account_activity = "ri-pulse-line";
      $__account_more     = "ri-more-2-line";

    } elseif($n_icon_fallback == "remix-solid") {

      // REMIX SOLID
      $__SCALE = "33px";
      $__home             = "ri-home-fill";
      $__admin            = "ri-equalizer-3-fill";
      $__account          = "ri-user-settings-fill";
      $__logout           = "ri-logout-box-r-fill";
      $__server_terminal  = "ri-terminal-box-fill";
      $__server_files     = "ri-folder-6-fill";
      $__server_databases = "ri-database-2-fill";
      $__server_schedules = "ri-calendar-fill";
      $__server_users     = "ri-group-fill";
      $__server_backups   = "ri-archive-fill";
      $__server_network   = "ri-arrow-up-down-fill";
      $__server_startup   = "ri-edit-box-fill";
      $__server_settings  = "ri-settings-fill";
      $__server_activity  = "ri-pulse-fill";
      $__server_more      = "ri-more-2-fill";
      $__account_account  = "ri-settings-fill";
      $__account_api      = "ri-global-fill";
      $__account_ssh      = "ri-key-2-fill";
      $__account_activity = "ri-pulse-fill";
      $__account_more     = "ri-more-2-fill";

    } elseif($n_icon_fallback == "tabler") {

      // TABLER ICONS
      $__SCALE = "36px";
      $__home             = "ti ti-home";
      $__admin            = "ti ti-server-cog";
      $__account          = "ti ti-user";
      $__logout           = "ti ti-logout";
      $__server_terminal  = "ti ti-terminal";
      $__server_files     = "ti ti-folder";
      $__server_databases = "ti ti-database";
      $__server_schedules = "ti ti-calendar";
      $__server_users     = "ti ti-users-plus";
      $__server_backups   = "ti ti-archive";
      $__server_network   = "ti ti-network";
      $__server_startup   = "ti ti-adjustments";
      $__server_settings  = "ti ti-settings";
      $__server_activity  = "ti ti-activity-heartbeat";
      $__server_more      = "ti ti-dots";
      $__account_account  = "ti ti-user-cog";
      $__account_api      = "ti ti-api";
      $__account_ssh      = "ti ti-key";
      $__account_activity = "ti ti-activity-heartbeat";
      $__account_more     = "ti ti-dots";

    } elseif($n_icon_fallback == "octicons") {

      // OCTICONS
      $__SCALE = "33px";
      $__home             = "octicon octicon-home-fill-24";
      $__admin            = "octicon octicon-tools-24";
      $__account          = "octicon octicon-person-24";
      $__logout           = "octicon octicon-sign-out-24";
      $__server_terminal  = "octicon octicon-terminal-24";
      $__server_files     = "octicon octicon-file-directory-24";
      $__server_databases = "octicon octicon-database-24";
      $__server_schedules = "octicon octicon-calendar-24";
      $__server_users     = "octicon octicon-people-24";
      $__server_backups   = "octicon octicon-archive-24";
      $__server_network   = "octicon octicon-globe-24";
      $__server_startup   = "octicon octicon-plug-24";
      $__server_settings  = "octicon octicon-gear-24";
      $__server_activity  = "octicon octicon-log-24";
      $__server_more      = "octicon octicon-kebab-horizontal-24";
      $__account_account  = "octicon octicon-smiley-24";
      $__account_api      = "octicon octicon-dependabot-24";
      $__account_ssh      = "octicon octicon-key-24";
      $__account_activity = "octicon octicon-log-24";
      $__account_more     = "octicon octicon-kebab-horizontal-24";

    } elseif($n_icon_fallback == "akar-icons") {

      // AKAR ICONS
      $__SCALE = "33px";
      $__home             = "ai-home";
      $__admin            = "ai-settings-vertical";
      $__account          = "ai-person";
      $__logout           = "ai-sign-out";
      $__server_terminal  = "ai-computing";
      $__server_files     = "ai-folder";
      $__server_databases = "ai-data";
      $__server_schedules = "ai-schedule";
      $__server_users     = "ai-people-multiple";
      $__server_backups   = "ai-cloud-download";
      $__server_network   = "ai-globe";
      $__server_startup   = "ai-edit";
      $__server_settings  = "ai-gear";
      $__server_activity  = "ai-clipboard";
      $__server_more      = "ai-more-vertical-fill";
      $__account_account  = "ai-face-very-happy";
      $__account_api      = "ai-globe";
      $__account_ssh      = "ai-key";
      $__account_activity = "ai-clipboard";
      $__account_more     = "ai-more-vertical-fill";

    } elseif($n_icon_fallback == "hugeicons-solid") {

      // HUGEICONS SOLID
      $__SCALE = "33px";
      $__home             = "hgi-solid hgi-home-01";
      $__admin            = "hgi-solid hgi-settings-02";
      $__account          = "hgi-solid hgi-user";
      $__logout           = "hgi-solid hgi-logout-03";
      $__server_terminal  = "hgi-solid hgi-software-license";
      $__server_files     = "hgi-solid hgi-folder-03";
      $__server_databases = "hgi-solid hgi-database-02";
      $__server_schedules = "hgi-solid hgi-calendar-03";
      $__server_users     = "hgi-solid hgi-user-group";
      $__server_backups   = "hgi-solid hgi-cloud-upload";
      $__server_network   = "hgi-solid hgi-cellular-network";
      $__server_startup   = "hgi-solid hgi-plug-socket";
      $__server_settings  = "hgi-solid hgi-settings-05";
      $__server_activity  = "hgi-solid hgi-book-02";
      $__server_more      = "hgi-solid hgi-more-vertical";
      $__account_account  = "hgi-solid hgi-user-edit-01";
      $__account_api      = "hgi-solid hgi-api";
      $__account_ssh      = "hgi-solid hgi-biometric-access";
      $__account_activity = "hgi-solid hgi-book-02";
      $__account_more     = "hgi-solid hgi-more-vertical";

    } elseif($n_icon_fallback == "hugeicons-stroke") {

      // HUGEICONS STROKE
      $__SCALE = "33px";
      $__home             = "hgi-stroke hgi-home-01";
      $__admin            = "hgi-stroke hgi-settings-02";
      $__account          = "hgi-stroke hgi-user";
      $__logout           = "hgi-stroke hgi-logout-03";
      $__server_terminal  = "hgi-stroke hgi-software-license";
      $__server_files     = "hgi-stroke hgi-folder-03";
      $__server_databases = "hgi-stroke hgi-database-02";
      $__server_schedules = "hgi-stroke hgi-calendar-03";
      $__server_users     = "hgi-stroke hgi-user-group";
      $__server_backups   = "hgi-stroke hgi-cloud-upload";
      $__server_network   = "hgi-stroke hgi-cellular-network";
      $__server_startup   = "hgi-stroke hgi-plug-socket";
      $__server_settings  = "hgi-stroke hgi-settings-05";
      $__server_activity  = "hgi-stroke hgi-book-02";
      $__server_more      = "hgi-stroke hgi-more-vertical";
      $__account_account  = "hgi-stroke hgi-user-edit-01";
      $__account_api      = "hgi-stroke hgi-api";
      $__account_ssh      = "hgi-stroke hgi-biometric-access";
      $__account_activity = "hgi-stroke hgi-book-02";
      $__account_more     = "hgi-stroke hgi-more-vertical";

    }


    /*
    elseif($n_icon_fallback == "pack-id") {

      // PACK NAME
      $__SCALE = "33px";
      $__home             = "";
      $__admin            = "";
      $__account          = "";
      $__logout           = "";
      $__server_terminal  = "";
      $__server_files     = "";
      $__server_databases = "";
      $__server_schedules = "";
      $__server_users     = "";
      $__server_backups   = "";
      $__server_network   = "";
      $__server_startup   = "";
      $__server_settings  = "";
      $__server_activity  = "";
      $__server_more      = "";
      $__account_account  = "";
      $__account_api      = "";
      $__account_ssh      = "";
      $__account_activity = "";
      $__account_more     = "";

    }
    */
  ?>
  @include('blueprint.extensions.nebula.wrapper.sidebar.content')
</div>

@include('blueprint.extensions.nebula.wrapper.contextmenu.files')
@include('blueprint.extensions.nebula.wrapper.contextmenu.more')
@include('blueprint.extensions.nebula.wrapper.contextmenu.sidebar')

@endif
<style id="nebula-components">

  #nebulaContextMenu,
  #filesContextMenu,
  #moreContextMenu {
    display: none
  }

  .nebulaFooter {
    text-align: center;
    font-size: 12px;
    font-weight: 300;
    color: #9aa5b1;
    text-decoration: none;
    padding-bottom: 10px;
  }

  @if($n_sidebar_hover_tooltip == 0 || $n_sidebar_hover_tooltip == 2 || $n_sidebar_full == 1)
    div.sidebarContent > div.tooltip-toggle > span.tooltip,
    div.sidebarContent > #sidebarCategoryServer > div.tooltip-toggle > span.tooltip,
    div.sidebarContent > #sidebarCategoryAccount > div.tooltip-toggle > span.tooltip,
    div.sidebarContent > #sidebarCategoryGeneral > div.tooltip-toggle > span.tooltip,
    div.sidebarContent > #sidebarCategoryGeneral > a > div.tooltip-toggle > span.tooltip {
      display: none
    }
  @endif

  /* Sidebar */
  @if($n_sidebar_background == "default")
  .sidebar {
    transition: 
      left 0.5s,
      width 1s !important;
    position: fixed;
    left: 0; top: 0px;
    width: 75px; height: 100%;
    background-color: var(--sidebarBackground);
    z-index: 5;
    border-radius: 0px var(--borderRadiusSidebar) var(--borderRadiusSidebar) 0px;
  }
  @elseif($n_sidebar_background == "blurred")
  .sidebar {
    transition: 
      left 0.5s,
      width 1s !important;
    position: fixed;
    left: 0; top: 0px;
    width: 75px; height: 100%;
    background-color: unset !important;
    background: linear-gradient(to bottom, color-mix(in hsl, var(--sidebarBackground) 30%, transparent), color-mix(in hsl, var(--sidebarBackground) 5%, transparent) 100%);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    will-change: transform;
    z-index: 5;
    border-radius: 0px;
  }
  @endif

  .sidebarContentContainer {
    margin: 0px 0px 10px 10px;
    overflow: visible;
  }

  .sidebarContent {
    height: 100vh;
    padding-top: 10px;
    overflow-y: scroll;
    overflow-x: visible;

    scrollbar-width: none;
    -ms-overflow-style: none;
    &::-webkit-scrollbar {
      display: none;
    }
  }

  /* Sidebar preloader */
  @keyframes sidebar-preloader {
    0%   { background-color: var(--sidebarSecondary) }
    20%  { background-color: color-mix(in hsl, var(--sidebarSecondary) 87%, white) }
    40%  { background-color: var(--sidebarSecondary) }
    100% { background-color: var(--sidebarSecondary) }
  }
  .sidebar-placeholder-animated {
    animation: sidebar-preloader 1s linear infinite;
    color: transparent;
    background-color: var(--sidebarSecondary);
  }

  .sidebar-placeholder-animated:nth-child(0) { animation-delay: 0s }
  .sidebar-placeholder-animated:nth-child(1) { animation-delay: .05s }
  .sidebar-placeholder-animated:nth-child(2) { animation-delay: .1s }
  .sidebar-placeholder-animated:nth-child(3) { animation-delay: .15s }
  .sidebar-placeholder-animated:nth-child(4) { animation-delay: .2s }
  .sidebar-placeholder-animated:nth-child(5) { animation-delay: .25s }
  .sidebar-placeholder-animated:nth-child(6) { animation-delay: .3s }
  .sidebar-placeholder-animated:nth-child(7) { animation-delay: .35s }
  .sidebar-placeholder-animated:nth-child(8) { animation-delay: .4s }
  .sidebar-placeholder-animated:nth-child(9) { animation-delay: .45s }
  .sidebar-placeholder-animated:nth-child(10) { animation-delay: .5s }

  /* Sidebar items */
  .sidebarButton {
    border: none;
    @if($n_sidebar_background == "default")
      background-color: var(--sidebarSecondary);
    @elseif($n_sidebar_background == "blurred")
      background-color: transparent;
    @endif
    width: calc(75px - 10px - 10px);
    height: calc(75px - 10px - 10px);
    border-radius: var(--borderRadiusSidebar);
    margin-bottom: 10px;
    overflow-x: hidden;
    overflow-y: hidden;
    position: relative;
    left: 0px;
    transition: 
      background-color 0.3s,
      border .2s,
      border-left .2s,
      margin-left .3s,
      left .3s,
      padding-top .3s,
      padding-bottom .3s,
      height .3s !important;
  }
  .sidebarButton:hover {
    @if($n_sidebar_background == "default")
      background-color: var(--sidebarSecondaryHover);
    @elseif($n_sidebar_background == "blurred")
      background-color: #ffffff20;
    @endif
  }
  .sidebarButton:active {
    @if($n_sidebar_background == "default")
      background-color: var(--sidebarSecondaryActive);
    @elseif($n_sidebar_background == "blurred")
      background-color: #ffffff15;
    @endif
  }

  .sidebarButtonSelected {
    @if($n_sidebar_background == "default")
      background-color: var(--sidebarButtonActive);
    @elseif($n_sidebar_background == "blurred")
      background-color: color-mix(in hsl, var(--sidebarButtonActive) 50%, transparent);
      --border: 1px solid rgba(255, 255, 255, 0.2) !important;
    @endif
  }

  .sidebarIcon {
    color: var(--sidebarPrimary);
    transition:
      color 0.3s,
      opacity 0.3s !important;
    
    @if(Auth::check())
      font-size: calc({{ $__SCALE }} * {{ $n_icon_scale }});
    @endif
  }
  .sidebarIcon:hover {
    color: var(--sidebarPrimaryHover);
  }

  .customicon {
    width: 100%;
    height: 100%;
    scale: calc({{ $n_icon_scale }});
    @if($n_icon_scale == "1.00")border-radius: var(--borderRadiusSidebar);@endif
  }

  @if($n_sidebar_separators == "1")
    .sidebarSpacer {
      padding-bottom: 12px;
      margin-left: 12.5%;
      margin-right: 12.5%;
      width: calc(75% - 10px);
      border-top: 1px solid var(--sidebarSecondary);
    }
  @endif

  .sidebarCategory {
    display: none;
  }

  @if(Auth::check())
    @if($n_background_image == "")
      @if($n_background_magic == "")
        body, body.bg-neutral-800 {
          padding-left: 75px;
          color: #fff;
          background-color: var(--pageBackground);
        }
      @else
        .fixed-pattern-background {
          display: block;
          position: fixed;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          z-index: -1;
        }
        body, body.bg-neutral-800, #app, .App___StyledDiv-sc-2l91w7-0 {
          background: unset !important;
        }
        body, body.bg-neutral-800 {
          padding-left: 75px;
          color: #fff;
        }
      @endif
    @else
      body, body.bg-neutral-800 {
        padding-left: 75px;
        color: #fff;
        background-color: #00000000;
      }
    @endif
  @else
    body, bg-neutral-800 {
      color: #fff;
      background-color: var(--pageBackground);
    }
  @endif

  html:not([multitasking]) {
    background-color: var(--pageBackground) !important;
    background: var(--pageBackground) !important;
    z-index: -2 !important;
  }

  @if($n_background_image != "")
    .fixed-background {
      background: url("{{ $n_background_image }}") no-repeat;
      @if($n_background_appearance == "1")filter: blur(40px);scale: 1.1;@endif
      @if($n_background_appearance == "2")opacity: 0.6;@endif
      z-index: -1;
      background-position: center;
      background-size: cover;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
    }
    body {
      z-index: 2;
    }
  @endif

  @if($n_sidebar_full == "1" && Auth::check())
    /* 
      wide sidebar
    */

    .sidebarIcon {
      float: left;
      margin-left: 15px;
      margin-top: {{ $__WIDE_TOPMARGIN }};
      padding-right: 13px;
      line-height: 55px;
      font-size: calc({{ $__SCALE }} * 0.8);
      width: calc({{ $__SCALE }} * 0.8 + 15px);
    }
    .nebula-mobile-nav { display: none; }
    .sidebar {
      width: 200px;
      display: block;
    }
    div.ProgressBar___StyledDiv-sc-14ayc3f-1.jleFWY {
      left: 195px !important;
      width: calc(100% - 195px) !important;
    }
    .sidebarContentContainer {
      width: 100%;
    }
    
    .customicon {
      height: 100%;
      aspect-ratio: 1/1;
      float: left;
      width: auto;
    }
    body, body.bg-neutral-800 {
      padding-left: 200px;
    }
    .sidebarSpacer {
      width: calc(100% - 31px);
      margin-left: 5px;
      margin-right: 5px;
    }
    .wideSidebarSpan {
      text-align: left;
      display: block;
      width: 100%;
      font-size: 17px;
      font-weight: 500;
      height: 100%;
      line-height: 55px;
      font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
    .sidebarButton {
      width: calc(100% - 10px - 10px);
      transition:
        border .2s,
        border-left .2s;
    }
    @if($n_sidebar_customlogo != "")
      /* custom logo */
      .customlogo {
        height: 62px;
        width: auto;
        margin-right: auto;
        border-radius: var(--borderRadiusSidebar);
        margin-bottom: 10px;
      }
    @endif
    @if($n_sidebar_buttonstyle == "1")
      .sidebarButton {
        border-left: 0px solid transparent;
      }
      .sidebarButtonSelected {
        @if($n_sidebar_background == "default")
          background-color: var(--sidebarSecondary);
        @endif
        border-left: 10px solid var(--sidebarButtonActive) !important;
        transition: border .2s, border-left .2s;
      }
    @elseif($n_sidebar_buttonstyle == "2")
      .sidebarIcon {
        line-height: 49px !important;
        margin-left: 12px !important;
      }
      .wideSidebarSpan {
        line-height: 49px !important;
      }
      .sidebarButton {
        --border: 3px solid transparent;
        border: 3px solid transparent !important;
        border-left: 3px solid transparent !important;
      }
      .sidebarButtonSelected {
        @if($n_sidebar_background == "default")
          background-color: var(--sidebarSecondary);
        @endif
        --border: 3px solid var(--sidebarButtonActive);
        border-left: 3px solid var(--sidebarButtonActive) !important;
        border: 3px solid var(--sidebarButtonActive) !important;
        transition: border .2s, border-left .2s;
      }
    @endif
  @endif

  @media screen and (min-width: 760px) {
    /* Sidebar hover animations */
    @if($n_sidebar_hover == "popout")
      .sidebarButton:hover {
        position: relative;
        left: 7px;
      }
    @elseif($n_sidebar_hover == "expand")
      .sidebarButton:hover {
        padding-top: 10px;
        padding-bottom: 10px; 
        height: calc(75px - 10px - 10px + 20px);
      }
    @endif
  }
</style>
@include('blueprint.extensions.nebula.wrapper.sidebar.mobile')
@include('blueprint.extensions.nebula.wrapper.theme.variables')
@if(Auth::check())
  @include('blueprint.extensions.nebula.wrapper.script')
  @include('blueprint.extensions.nebula.wrapper.animations')
@endif
@include('blueprint.extensions.nebula.wrapper.theme.auth')
@include('blueprint.extensions.nebula.wrapper.theme.panel')
@endif
@include('blueprint.extensions.nebula.wrapper.initialize.index')
@if($n_init == "2.0-1")
@if(Auth::check() != true)
  <div
    <?php
      if($n_auth_background_magic != "") {
        echo('class="nebula-auth-wallpaper magic-pattern['.$n_auth_background_magic.']" view="auth"');
      } else {
        echo('class="nebula-auth-wallpaper"');
      }
    ?>
  ></div>
  <div class="nebula-auth-backdrop"></div>
  @if($n_watermark_auth != "0")
    <div class="nebula-watermark">Powered by <a href="https://nebula.style/"><b class="watermark-highlight"><i class="bi bi-exclude"></i> Nebula</b></a></div>
  @endif
  <style>.g-recaptcha {display: none !important;}</style>
  @if($blueprint->dbGet("settings", "recaptcha:enabled") == "true")
    <div class="notification">
      <div class="notificationBar"></div>
      <div class="notificationIcon"></div>
      <div class="notificationTextContainer">
        <p class="notificationText"><b style="font-size: 14px;">Protected by reCAPTCHA</b><br>
        <span style="font-size: 12px;"><a href="https://www.google.com/intl/en/policies/privacy/" style="color: #4D4DFF;">Privacy</a>, <a href="https://www.google.com/intl/en/policies/terms/" style="color: #4D4DFF;">Terms</a></span></p>
      </div>
    </div>
  @endif
@endif
@if(Auth::check())
  @include('blueprint.extensions.nebula.wrapper.file-switch')
@if($n_keyboard_shortcuts == "1") 
  @include('blueprint.extensions.nebula.wrapper.keybinds.index')
@endif
@endif
@endif