<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\nebula;

use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;
use Illuminate\Http\RedirectResponse;

use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintExtensionLibrary;

class nebulaExtensionController extends Controller
{
  public function __construct(
    private ViewFactory $view,
    private BlueprintExtensionLibrary $blueprint,
    private ConfigRepository $config,
    private SettingsRepositoryInterface $settings,
  ) {}
  
  public function index(): RedirectResponse
  {
    // GET DATABASE VALUES
    $sidebar_home = $this->blueprint->dbGet('nebula', 'sidebar_home');
    $sidebar_admin = $this->blueprint->dbGet('nebula', 'sidebar_admin');
    $sidebar_account = $this->blueprint->dbGet('nebula', 'sidebar_account');
    $sidebar_logout = $this->blueprint->dbGet('nebula', 'sidebar_logout');
    $sidebar_server_terminal = $this->blueprint->dbGet('nebula', 'sidebar_server_terminal');
    $sidebar_server_files = $this->blueprint->dbGet('nebula', 'sidebar_server_files');
    $sidebar_server_databases = $this->blueprint->dbGet('nebula', 'sidebar_server_databases');
    $sidebar_server_schedules = $this->blueprint->dbGet('nebula', 'sidebar_server_schedules');
    $sidebar_server_users = $this->blueprint->dbGet('nebula', 'sidebar_server_users');
    $sidebar_server_backups = $this->blueprint->dbGet('nebula', 'sidebar_server_backups');
    $sidebar_server_network = $this->blueprint->dbGet('nebula', 'sidebar_server_network');
    $sidebar_server_startup = $this->blueprint->dbGet('nebula', 'sidebar_server_startup');
    $sidebar_server_settings = $this->blueprint->dbGet('nebula', 'sidebar_server_settings');
    $sidebar_server_activity = $this->blueprint->dbGet('nebula', 'sidebar_server_activity');
    $sidebar_server_more = $this->blueprint->dbGet('nebula', 'sidebar_server_more');
    $sidebar_account_account = $this->blueprint->dbGet('nebula', 'sidebar_account_account');
    $sidebar_account_api = $this->blueprint->dbGet('nebula', 'sidebar_account_api');
    $sidebar_account_ssh = $this->blueprint->dbGet('nebula', 'sidebar_account_ssh');
    $sidebar_account_activity = $this->blueprint->dbGet('nebula', 'sidebar_account_activity');
    $sidebar_account_more = $this->blueprint->dbGet('nebula', 'sidebar_account_more');
    $icon_scale = $this->blueprint->dbGet('nebula', 'icon_scale');
    $watermark = $this->blueprint->dbGet('nebula', 'watermark');
    $init = $this->blueprint->dbGet('nebula', 'init');
    $background_image = $this->blueprint->dbGet('nebula', 'background_image');
    $sidebar_background = $this->blueprint->dbGet('nebula', 'sidebar_background');
    $background_appearance = $this->blueprint->dbGet('nebula', 'background_appearance');
    $background_magic = $this->blueprint->dbGet('nebula', 'background_magic');
    $background_magicsize = $this->blueprint->dbGet('nebula', 'background_magicsize');
    $auth_background_image = $this->blueprint->dbGet('nebula', 'auth_background_image');
    $auth_background_appearance = $this->blueprint->dbGet('nebula', 'auth_background_appearance');
    $auth_background_magic = $this->blueprint->dbGet('nebula', 'auth_background_magic');
    $auth_background_magicsize = $this->blueprint->dbGet('nebula', 'auth_background_magicsize');
    $palette_dashboard_1 = $this->blueprint->dbGet('nebula', 'palette_dashboard_1');
    $palette_dashboard_2 = $this->blueprint->dbGet('nebula', 'palette_dashboard_2');
    $palette_dashboard_3 = $this->blueprint->dbGet('nebula', 'palette_dashboard_3');
    $palette_dashboard_4 = $this->blueprint->dbGet('nebula', 'palette_dashboard_4');
    $palette_dashboard_5 = $this->blueprint->dbGet('nebula', 'palette_dashboard_5');
    $palette_dashboard_6 = $this->blueprint->dbGet('nebula', 'palette_dashboard_6');
    $palette_dashboard_7 = $this->blueprint->dbGet('nebula', 'palette_dashboard_7');
    $palette_dashboard_8 = $this->blueprint->dbGet('nebula', 'palette_dashboard_8');
    $palette_dashboard_9 = $this->blueprint->dbGet('nebula', 'palette_dashboard_9');
    $palette_sidebar_1 = $this->blueprint->dbGet('nebula', 'palette_sidebar_1');
    $palette_sidebar_2 = $this->blueprint->dbGet('nebula', 'palette_sidebar_2');
    $palette_sidebar_3 = $this->blueprint->dbGet('nebula', 'palette_sidebar_3');
    $palette_sidebar_4 = $this->blueprint->dbGet('nebula', 'palette_sidebar_4');
    $palette_sidebar_5 = $this->blueprint->dbGet('nebula', 'palette_sidebar_5');
    $palette_sidebar_6 = $this->blueprint->dbGet('nebula', 'palette_sidebar_6');
    $palette_sidebar_7 = $this->blueprint->dbGet('nebula', 'palette_sidebar_7');
    $palette_sidebar_8 = $this->blueprint->dbGet('nebula', 'palette_sidebar_8');
    $palette_auth_1 = $this->blueprint->dbGet('nebula', 'palette_auth_1');
    $palette_auth_2 = $this->blueprint->dbGet('nebula', 'palette_auth_2');
    $palette_auth_3 = $this->blueprint->dbGet('nebula', 'palette_auth_3');
    $palette_auth_4 = $this->blueprint->dbGet('nebula', 'palette_auth_4');
    $palette_auth_5 = $this->blueprint->dbGet('nebula', 'palette_auth_5');
    $palette_auth_6 = $this->blueprint->dbGet('nebula', 'palette_auth_6');
    $palette_auth_7 = $this->blueprint->dbGet('nebula', 'palette_auth_7');
    $palette_auth_8 = $this->blueprint->dbGet('nebula', 'palette_auth_8');
    $keyboard_shortcuts = $this->blueprint->dbGet('nebula', 'keyboard_shortcuts');
    $keybind_icons = $this->blueprint->dbGet('nebula', 'keybind_icons');
    $sidebar_hover_tooltip = $this->blueprint->dbGet('nebula', 'sidebar_hover_tooltip');
    $server_overview_graphs = $this->blueprint->dbGet('nebula', 'server_overview_graphs');
    $server_colored_power = $this->blueprint->dbGet('nebula', 'server_colored_power');
    $sidebar_always_visible_buttons = $this->blueprint->dbGet('nebula', 'sidebar_always_visible_buttons');
    $icon_fallback = $this->blueprint->dbGet('nebula', 'icon_fallback');
    $dashboard_transparency = $this->blueprint->dbGet('nebula', 'dashboard_transparency');
    $page_indexing = $this->blueprint->dbGet('nebula', 'page_indexing');
    $website_links = $this->blueprint->dbGet('nebula', 'website_links');
    $weblink_support = $this->blueprint->dbGet('nebula', 'weblink_support');
    $weblink_billing = $this->blueprint->dbGet('nebula', 'weblink_billing');
    $weblink_status = $this->blueprint->dbGet('nebula', 'weblink_status');
    $weblink_social_discord = $this->blueprint->dbGet('nebula', 'weblink_social_discord');
    $weblink_social_github = $this->blueprint->dbGet('nebula', 'weblink_social_github');
    $website_links_align = $this->blueprint->dbGet('nebula', 'website_links_align');
    $alert = $this->blueprint->dbGet('nebula', 'alert');
    $alert_text = $this->blueprint->dbGet('nebula', 'alert_text');
    $alert_icon = $this->blueprint->dbGet('nebula', 'alert_icon');
    $watermark_auth = $this->blueprint->dbGet('nebula', 'watermark_auth');
    $server_list = $this->blueprint->dbGet('nebula', 'server_list');
    $reset = $this->blueprint->dbGet('nebula', 'reset');
    $border_radius = $this->blueprint->dbGet('nebula', 'border_radius');
    $sidebar_full = $this->blueprint->dbGet('nebula', 'sidebar_full');
    $sidebar_buttonstyle = $this->blueprint->dbGet('nebula', 'sidebar_buttonstyle');
    $sidebar_customlogo = $this->blueprint->dbGet('nebula', 'sidebar_customlogo');
    $auth_customlogo = $this->blueprint->dbGet('nebula', 'auth_customlogo');
    $alert_position = $this->blueprint->dbGet('nebula', 'alert_position');
    $sidebar_border_radius = $this->blueprint->dbGet('nebula', 'sidebar_border_radius');
    $alert_dismiss = $this->blueprint->dbGet('nebula', 'alert_dismiss');
    $palette_status_offline = $this->blueprint->dbGet('nebula', 'palette_status_offline');
    $palette_status_error = $this->blueprint->dbGet('nebula', 'palette_status_error');
    $palette_status_starting = $this->blueprint->dbGet('nebula', 'palette_status_starting');
    $palette_status_online = $this->blueprint->dbGet('nebula', 'palette_status_online');
    $statusgradient_style = $this->blueprint->dbGet('nebula', 'statusgradient_style');
    $sidebar_hover = $this->blueprint->dbGet('nebula', 'sidebar_hover');
    $animations = $this->blueprint->dbGet('nebula', 'animations');
    $sidebar_separators = $this->blueprint->dbGet('nebula', 'sidebar_separators');

    if($init != "2.0-1") {
      $this->blueprint->dbSet('nebula', 'init', '');
      $init = '';
    }

    // SET DEFAULT DATABASE VALUES
    $defaultSidebar_home = "";
    $defaultSidebar_admin = "";
    $defaultSidebar_account = "";
    $defaultSidebar_logout = "";
    $defaultSidebar_server_terminal = "";
    $defaultSidebar_server_files = "";
    $defaultSidebar_server_databases = "";
    $defaultSidebar_server_schedules = "";
    $defaultSidebar_server_users = "";
    $defaultSidebar_server_backups = "";
    $defaultSidebar_server_network = "";
    $defaultSidebar_server_startup = "";
    $defaultSidebar_server_settings = "";
    $defaultSidebar_server_activity = "";
    $defaultSidebar_server_more = "";
    $defaultSidebar_account_account = "";
    $defaultSidebar_account_api = "";
    $defaultSidebar_account_ssh = "";
    $defaultSidebar_account_activity = "";
    $defaultSidebar_account_more = "";
    $defaultIcon_scale = "0.90";
    $defaultWatermark = "1";
    $defaultInit = "2.0-1";
    $defaultBackground_image = "";
    $defaultSidebar_background = "default";
    $defaultBackground_appearance = "0";
    $defaultBackground_magic = "";
    $defaultBackground_magicsize = "215";
    $defaultAuth_background_image = "";
    $defaultAuth_background_appearance = "0";
    $defaultAuth_background_magic = "";
    $defaultAuth_background_magicsize = "215";
    $defaultPalette_dashboard_1 = "#e9eaee";
    $defaultPalette_dashboard_2 = "#7a98ff";
    $defaultPalette_dashboard_3 = "#251f30";
    $defaultPalette_dashboard_4 = "#2b2f3e";
    $defaultPalette_dashboard_5 = "#303443";
    $defaultPalette_dashboard_6 = "#363e57";
    $defaultPalette_dashboard_7 = "#040814";
    $defaultPalette_dashboard_8 = "#3a435c";
    $defaultPalette_dashboard_9 = "#4f6295";
    $defaultPalette_sidebar_1 = "#ffffff";
    $defaultPalette_sidebar_2 = "#ffffff";
    $defaultPalette_sidebar_3 = "#251f30";
    $defaultPalette_sidebar_4 = "#23293e";
    $defaultPalette_sidebar_5 = "#23293e";
    $defaultPalette_sidebar_6 = "#7a98ff";
    $defaultPalette_sidebar_7 = "#040814";
    $defaultPalette_sidebar_8 = "#7a98ff";
    $defaultPalette_auth_1 = "#040814";
    $defaultPalette_auth_2 = "#251f30";
    $defaultPalette_auth_3 = "#2b2f3e";
    $defaultPalette_auth_4 = "#3a435c";
    $defaultPalette_auth_5 = "#e18989";
    $defaultPalette_auth_6 = "#4f6295";
    $defaultPalette_auth_7 = "#47526a";
    $defaultPalette_auth_8 = "#e9eaee";
    $defaultKeyboard_shortcuts = "1";
    $defaultKeybind_icons = "1";
    $defaultSidebar_hover_tooltip = "2";
    $defaultServer_overview_graphs = "1";
    $defaultServer_colored_power = "0";
    $defaultSidebar_always_visible_buttons = "1";
    $defaultIcon_fallback = "bootstrap";
    $defaultDashboard_transparency = "0";
    $defaultPage_indexing = "1";
    $defaultWebsite_links = "0";
    $defaultWeblink_support = "";
    $defaultWeblink_billing = "";
    $defaultWeblink_status = "";
    $defaultWeblink_social_discord = "";
    $defaultWeblink_social_github = "";
    $defaultWebsite_links_align = "0";
    $defaultAlert = "0";
    $defaultAlert_text = "";
    $defaultAlert_icon = "megaphone-fill";
    $defaultWatermark_auth = "1";
    $defaultServer_list = "cards";
    $defaultReset = "0";
    $defaultBorder_radius = "10";
    $defaultSidebar_full = "0";
    $defaultSidebar_buttonstyle = "0";
    $defaultSidebar_customlogo = "";
    $defaultAuth_customlogo = "";
    $defaultAlert_position = "sticky";
    $defaultSidebar_border_radius = "10";
    $defaultAlert_dismiss = "0";
    $defaultPalette_status_offline = "#787474";
    $defaultPalette_status_error = "#bc362f";
    $defaultPalette_status_starting = "#dbc025";
    $defaultPalette_status_online = "#2cdd2f";
    $defaultStatusgradient_style = "default";
    $defaultSidebar_hover = "popout";
    $defaultAnimations = "fadeup";
    $defaultSidebar_separators = "1";
    
    // APPLY DEFAULT DATABASE VALUES
    if($sidebar_home == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_home', "$defaultSidebar_home");$sidebar_home = $this->blueprint->dbGet('nebula', 'sidebar_home');}
    if($sidebar_admin == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_admin', "$defaultSidebar_admin");$sidebar_admin = $this->blueprint->dbGet('nebula', 'sidebar_admin');}
    if($sidebar_account == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account', "$defaultSidebar_account");$sidebar_account = $this->blueprint->dbGet('nebula', 'sidebar_account');}
    if($sidebar_logout == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_logout', "$defaultSidebar_logout");$sidebar_logout = $this->blueprint->dbGet('nebula', 'sidebar_logout');}
    if($sidebar_server_terminal == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_terminal', "$defaultSidebar_server_terminal");$sidebar_server_terminal = $this->blueprint->dbGet('nebula', 'sidebar_server_terminal');}
    if($sidebar_server_files == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_files', "$defaultSidebar_server_files");$sidebar_server_files = $this->blueprint->dbGet('nebula', 'sidebar_server_files');}
    if($sidebar_server_databases == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_databases', "$defaultSidebar_server_databases");$sidebar_server_databases = $this->blueprint->dbGet('nebula', 'sidebar_server_databases');}
    if($sidebar_server_schedules == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_schedules', "$defaultSidebar_server_schedules");$sidebar_server_schedules = $this->blueprint->dbGet('nebula', 'sidebar_server_schedules');}
    if($sidebar_server_users == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_users', "$defaultSidebar_server_users");$sidebar_server_users = $this->blueprint->dbGet('nebula', 'sidebar_server_users');}
    if($sidebar_server_backups == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_backups', "$defaultSidebar_server_backups");$sidebar_server_backups = $this->blueprint->dbGet('nebula', 'sidebar_server_backups');}
    if($sidebar_server_network == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_network', "$defaultSidebar_server_network");$sidebar_server_network = $this->blueprint->dbGet('nebula', 'sidebar_server_network');}
    if($sidebar_server_startup == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_startup', "$defaultSidebar_server_startup");$sidebar_server_startup = $this->blueprint->dbGet('nebula', 'sidebar_server_startup');}
    if($sidebar_server_settings == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_settings', "$defaultSidebar_server_settings");$sidebar_server_settings = $this->blueprint->dbGet('nebula', 'sidebar_server_settings');}
    if($sidebar_server_activity == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_activity', "$defaultSidebar_server_activity");$sidebar_server_activity = $this->blueprint->dbGet('nebula', 'sidebar_server_activity');}
    if($sidebar_server_more == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_server_more', $defaultSidebar_server_more);$sidebar_server_more = $this->blueprint->dbGet('nebula', 'sidebar_server_more');}
    if($sidebar_account_account == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account_account', "$defaultSidebar_account_account");$sidebar_account_account = $this->blueprint->dbGet('nebula', 'sidebar_account_account');}
    if($sidebar_account_api == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account_api', "$defaultSidebar_account_api");$sidebar_account_api = $this->blueprint->dbGet('nebula', 'sidebar_account_api');}
    if($sidebar_account_ssh == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account_ssh', "$defaultSidebar_account_ssh");$sidebar_account_ssh = $this->blueprint->dbGet('nebula', 'sidebar_account_ssh');}
    if($sidebar_account_activity == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account_activity', "$defaultSidebar_account_activity");$sidebar_account_activity = $this->blueprint->dbGet('nebula', 'sidebar_account_activity');}
    if($sidebar_account_more == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_account_more', "$defaultSidebar_account_more");$sidebar_account_more = $this->blueprint->dbGet('nebula', 'sidebar_account_more');}
    if($icon_scale == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'icon_scale', $defaultIcon_scale);$icon_scale = $this->blueprint->dbGet('nebula', 'icon_scale');}
    if($watermark == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'watermark', $defaultWatermark);$watermark = $this->blueprint->dbGet('nebula', 'watermark');}
    if($init != "2.0-1" || $reset == "1") {$this->blueprint->dbSet('nebula', 'init', $defaultInit);$init = $this->blueprint->dbGet('nebula', 'init');}
    if($background_image == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'background_image', $defaultBackground_image);$background_image = $this->blueprint->dbGet('nebula', 'background_image');}
    if($sidebar_background == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_background', $defaultSidebar_background);$sidebar_background = $this->blueprint->dbGet('nebula', 'sidebar_background');}
    if($background_appearance == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'background_appearance', $defaultBackground_appearance);$background_appearance = $this->blueprint->dbGet('nebula', 'background_appearance');}
    if($background_magic == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'background_magic', $defaultBackground_magic);$background_magic = $this->blueprint->dbGet('nebula', 'background_magic');}
    if($background_magicsize == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'background_magicsize', $defaultBackground_magicsize);$background_magicsize = $this->blueprint->dbGet('nebula', 'background_magicsize');}
    if($auth_background_image == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'auth_background_image', $defaultAuth_background_image);$auth_background_image = $this->blueprint->dbGet('nebula', 'auth_background_image');}
    if($auth_background_appearance == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'auth_background_appearance', $defaultAuth_background_appearance);$auth_background_appearance = $this->blueprint->dbGet('nebula', 'auth_background_appearance');}
    if($auth_background_magic == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'auth_background_magic', $defaultAuth_background_magic);$auth_background_magic = $this->blueprint->dbGet('nebula', 'auth_background_magic');}
    if($auth_background_magicsize == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'auth_background_magicsize', $defaultAuth_background_magicsize);$auth_background_magicsize = $this->blueprint->dbGet('nebula', 'auth_background_magicsize');}
    if($palette_dashboard_1 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_1', $defaultPalette_dashboard_1);$palette_dashboard_1 = $this->blueprint->dbGet('nebula', 'palette_dashboard_1');}
    if($palette_dashboard_2 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_2', $defaultPalette_dashboard_2);$palette_dashboard_2 = $this->blueprint->dbGet('nebula', 'palette_dashboard_2');}
    if($palette_dashboard_3 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_3', $defaultPalette_dashboard_3);$palette_dashboard_3 = $this->blueprint->dbGet('nebula', 'palette_dashboard_3');}
    if($palette_dashboard_4 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_4', $defaultPalette_dashboard_4);$palette_dashboard_4 = $this->blueprint->dbGet('nebula', 'palette_dashboard_4');}
    if($palette_dashboard_5 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_5', $defaultPalette_dashboard_5);$palette_dashboard_5 = $this->blueprint->dbGet('nebula', 'palette_dashboard_5');}
    if($palette_dashboard_6 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_6', $defaultPalette_dashboard_6);$palette_dashboard_6 = $this->blueprint->dbGet('nebula', 'palette_dashboard_6');}
    if($palette_dashboard_7 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_7', $defaultPalette_dashboard_7);$palette_dashboard_7 = $this->blueprint->dbGet('nebula', 'palette_dashboard_7');}
    if($palette_dashboard_8 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_8', $defaultPalette_dashboard_8);$palette_dashboard_8 = $this->blueprint->dbGet('nebula', 'palette_dashboard_8');}
    if($palette_dashboard_9 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_dashboard_9', $defaultPalette_dashboard_9);$palette_dashboard_9 = $this->blueprint->dbGet('nebula', 'palette_dashboard_9');}
    if($palette_sidebar_1 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_1', $defaultPalette_sidebar_1);$palette_sidebar_1 = $this->blueprint->dbGet('nebula', 'palette_sidebar_1');}
    if($palette_sidebar_2 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_2', $defaultPalette_sidebar_2);$palette_sidebar_2 = $this->blueprint->dbGet('nebula', 'palette_sidebar_2');}
    if($palette_sidebar_3 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_3', $defaultPalette_sidebar_3);$palette_sidebar_3 = $this->blueprint->dbGet('nebula', 'palette_sidebar_3');}
    if($palette_sidebar_4 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_4', $defaultPalette_sidebar_4);$palette_sidebar_4 = $this->blueprint->dbGet('nebula', 'palette_sidebar_4');}
    if($palette_sidebar_5 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_5', $defaultPalette_sidebar_5);$palette_sidebar_5 = $this->blueprint->dbGet('nebula', 'palette_sidebar_5');}
    if($palette_sidebar_6 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_6', $defaultPalette_sidebar_6);$palette_sidebar_6 = $this->blueprint->dbGet('nebula', 'palette_sidebar_6');}
    if($palette_sidebar_7 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_7', $defaultPalette_sidebar_7);$palette_sidebar_7 = $this->blueprint->dbGet('nebula', 'palette_sidebar_7');}
    if($palette_sidebar_8 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_sidebar_8', $defaultPalette_sidebar_8);$palette_sidebar_8 = $this->blueprint->dbGet('nebula', 'palette_sidebar_8');}
    if($palette_auth_1 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_1', $defaultPalette_auth_1);$palette_auth_1 = $this->blueprint->dbGet('nebula', 'palette_auth_1');}
    if($palette_auth_2 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_2', $defaultPalette_auth_2);$palette_auth_2 = $this->blueprint->dbGet('nebula', 'palette_auth_2');}
    if($palette_auth_3 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_3', $defaultPalette_auth_3);$palette_auth_3 = $this->blueprint->dbGet('nebula', 'palette_auth_3');}
    if($palette_auth_4 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_4', $defaultPalette_auth_4);$palette_auth_4 = $this->blueprint->dbGet('nebula', 'palette_auth_4');}
    if($palette_auth_5 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_5', $defaultPalette_auth_5);$palette_auth_5 = $this->blueprint->dbGet('nebula', 'palette_auth_5');}
    if($palette_auth_6 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_6', $defaultPalette_auth_6);$palette_auth_6 = $this->blueprint->dbGet('nebula', 'palette_auth_6');}
    if($palette_auth_7 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_7', $defaultPalette_auth_7);$palette_auth_7 = $this->blueprint->dbGet('nebula', 'palette_auth_7');}
    if($palette_auth_8 == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_auth_8', $defaultPalette_auth_8);$palette_auth_8 = $this->blueprint->dbGet('nebula', 'palette_auth_8');}
    if($keyboard_shortcuts == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'keyboard_shortcuts', $defaultKeyboard_shortcuts);$keyboard_shortcuts = $this->blueprint->dbGet('nebula', 'keyboard_shortcuts');}
    if($keybind_icons == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'keybind_icons', $defaultKeybind_icons);$keybind_icons = $this->blueprint->dbGet('nebula', 'keybind_icons');}
    if($sidebar_hover_tooltip == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_hover_tooltip', $defaultSidebar_hover_tooltip);$sidebar_hover_tooltip = $this->blueprint->dbGet('nebula', 'sidebar_hover_tooltip');}
    if($server_overview_graphs == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'server_overview_graphs', $defaultServer_overview_graphs);$server_overview_graphs = $this->blueprint->dbGet('nebula', 'server_overview_graphs');}
    if($server_colored_power == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'server_colored_power', $defaultServer_colored_power);$server_colored_power = $this->blueprint->dbGet('nebula', 'server_colored_power');}
    if($sidebar_always_visible_buttons == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_always_visible_buttons', $defaultSidebar_always_visible_buttons);$sidebar_always_visible_buttons = $this->blueprint->dbGet('nebula', 'sidebar_always_visible_buttons');}
    if($icon_fallback == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'icon_fallback', $defaultIcon_fallback);$icon_fallback = $this->blueprint->dbGet('nebula', 'icon_fallback');}
    if($dashboard_transparency == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'dashboard_transparency', $defaultDashboard_transparency);$dashboard_transparency = $this->blueprint->dbGet('nebula', 'dashboard_transparency');}
    if($page_indexing == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'page_indexing', $defaultPage_indexing);$page_indexing = $this->blueprint->dbGet('nebula', 'page_indexing');}
    if($website_links == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'website_links', $defaultWebsite_links);$website_links = $this->blueprint->dbGet('nebula', 'website_links');}
    if($weblink_support == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'weblink_support', $defaultWeblink_support);$weblink_support = $this->blueprint->dbGet('nebula', 'weblink_support');}
    if($weblink_billing == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'weblink_billing', $defaultWeblink_billing);$weblink_billing = $this->blueprint->dbGet('nebula', 'weblink_billing');}
    if($weblink_status == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'weblink_status', $defaultWeblink_status);$weblink_status = $this->blueprint->dbGet('nebula', 'weblink_status');}
    if($weblink_social_discord == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'weblink_social_discord', $defaultWeblink_social_discord);$weblink_social_discord = $this->blueprint->dbGet('nebula', 'weblink_social_discord');}
    if($weblink_social_github == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'weblink_social_github', $defaultWeblink_social_github);$weblink_social_github = $this->blueprint->dbGet('nebula', 'weblink_social_github');}
    if($website_links_align == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'website_links_align', $defaultWebsite_links_align);$website_links_align = $this->blueprint->dbGet('nebula', 'website_links_align');}
    if($alert == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'alert', $defaultAlert);$alert = $this->blueprint->dbGet('nebula', 'alert');}
    if($alert_text == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'alert_text', $defaultAlert_text);$alert_text = $this->blueprint->dbGet('nebula', 'alert_text');}
    if($alert_icon == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'alert_icon', $defaultAlert_icon);$alert_icon = $this->blueprint->dbGet('nebula', 'alert_icon');}
    if($watermark_auth == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'watermark_auth', $defaultWatermark_auth);$watermark_auth = $this->blueprint->dbGet('nebula', 'watermark_auth');}
    if($server_list == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'server_list', $defaultServer_list);$server_list = $this->blueprint->dbGet('nebula', 'server_list');}
    if($reset == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'reset', $defaultReset);}
    if($border_radius == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'border_radius', $defaultBorder_radius);$border_radius = $this->blueprint->dbGet('nebula', 'border_radius');}
    if($sidebar_full == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_full', $defaultSidebar_full);$sidebar_full = $this->blueprint->dbGet('nebula', 'sidebar_full');}
    if($sidebar_buttonstyle == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_buttonstyle', $defaultSidebar_buttonstyle);$sidebar_buttonstyle = $this->blueprint->dbGet('nebula', 'sidebar_buttonstyle');}
    if($sidebar_customlogo == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_customlogo', $defaultSidebar_customlogo);$sidebar_customlogo = $this->blueprint->dbGet('nebula', 'sidebar_customlogo');}
    if($auth_customlogo == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'auth_customlogo', $defaultAuth_customlogo);$auth_customlogo = $this->blueprint->dbGet('nebula', 'auth_customlogo');}
    if($alert_position == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'alert_position', $defaultAlert_position);$alert_position = $this->blueprint->dbGet('nebula', 'alert_position');}
    if($sidebar_border_radius == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_border_radius', $defaultSidebar_border_radius);$sidebar_border_radius = $this->blueprint->dbGet('nebula', 'sidebar_border_radius');}
    if($alert_dismiss == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'alert_dismiss', $defaultAlert_dismiss);$alert_dismiss = $this->blueprint->dbGet('nebula', 'alert_dismiss');}
    if($palette_status_offline == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_status_offline', $defaultPalette_status_offline);$palette_status_offline = $this->blueprint->dbGet('nebula', 'palette_status_offline');}
    if($palette_status_error == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_status_error', $defaultPalette_status_error);$palette_status_error = $this->blueprint->dbGet('nebula', 'palette_status_error');}
    if($palette_status_starting == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_status_starting', $defaultPalette_status_starting);$palette_status_starting = $this->blueprint->dbGet('nebula', 'palette_status_starting');}
    if($palette_status_online == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'palette_status_online', $defaultPalette_status_online);$palette_status_online = $this->blueprint->dbGet('nebula', 'palette_status_online');}
    if($statusgradient_style == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'statusgradient_style', $defaultStatusgradient_style);$statusgradient_style = $this->blueprint->dbGet('nebula', 'statusgradient_style');}
    if($sidebar_hover == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_hover', $defaultSidebar_hover);$sidebar_hover = $this->blueprint->dbGet('nebula', 'sidebar_hover');}
    if($animations == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'animations', $defaultAnimations);$animations = $this->blueprint->dbGet('nebula', 'animations');}
    if($sidebar_separators == "" || $reset == "1") {$this->blueprint->dbSet('nebula', 'sidebar_separators', $defaultSidebar_separators);$sidebar_separators = $this->blueprint->dbGet('nebula', 'sidebar_separators');}

    if($reset == "1") { return redirect("/extensions/nebula/editor/edit/more.php?reset=true"); }
    else { return redirect("/extensions/nebula/editor/index.html"); }
  }
  /**
   * @throws \Pterodactyl\Exceptions\Model\DataValidationException
   * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
   */
  public function update(NebulaSettingsFormRequest $request): RedirectResponse
  {
    foreach ($request->normalize() as $key => $value) {
      $this->settings->set('nebula::' . $key, $value);
    }
    $endpoint = $request->input('_endpoint', '/admin/extensions/nebula');
    return redirect("$endpoint");
  }
}
class NebulaSettingsFormRequest extends AdminFormRequest
{
  public function rules(): array
  {
    return [
      'sidebar_home' => 'string|nullable|url:http,https',
      'sidebar_admin' => 'string|nullable|url:http,https',
      'sidebar_account' => 'string|nullable|url:http,https',
      'sidebar_logout' => 'string|nullable|url:http,https',
      'sidebar_server_terminal' => 'string|nullable|url:http,https',
      'sidebar_server_files' => 'string|nullable|url:http,https',
      'sidebar_server_databases' => 'string|nullable|url:http,https',
      'sidebar_server_schedules' => 'string|nullable|url:http,https',
      'sidebar_server_users' => 'string|nullable|url:http,https',
      'sidebar_server_backups' => 'string|nullable|url:http,https',
      'sidebar_server_network' => 'string|nullable|url:http,https',
      'sidebar_server_startup' => 'string|nullable|url:http,https',
      'sidebar_server_settings' => 'string|nullable|url:http,https',
      'sidebar_server_activity' => 'string|nullable|url:http,https',
      'sidebar_server_more' => 'string|nullable|url:http,https',
      'sidebar_account_account' => 'string|nullable|url:http,https',
      'sidebar_account_api' => 'string|nullable|url:http,https',
      'sidebar_account_ssh' => 'string|nullable|url:http,https',
      'sidebar_account_activity' => 'string|nullable|url:http,https',
      'sidebar_account_more' => 'string|nullable|url:http,https',
      'icon_scale' => 'numeric|lte:1|gte:0.10',
      'watermark' => 'boolean',
      'background_image' => 'string|nullable|url:http,https',
      'sidebar_background' => 'string|in:default,blurred',
      'background_appearance' => 'string|decimal:0|lte:2|gte:0',
      'background_magic' => 'string|nullable|in:tiles,cubes,rotated-squares,l-shape,zig-zag,wavy-checkerboard,chevrons,houndstooth,quarter-circles,diagonal-rectangles,alternating-arc,rotated-rectangles,concentric-arrows,outline-triangles,moon,polka',
      'background_magicsize' => 'numeric|decimal:0|lte:500|gte:50',
      'auth_background_image' => 'string|nullable|url:http,https',
      'auth_background_appearance' => 'string|decimal:0|lte:2|gte:0',
      'auth_background_magic' => 'string|nullable|in:tiles,cubes,rotated-squares,l-shape,zig-zag,wavy-checkerboard,chevrons,houndstooth,quarter-circles,diagonal-rectangles,alternating-arc,rotated-rectangles,concentric-arrows,outline-triangles,moon,polka',
      'auth_background_magicsize' => 'numeric|decimal:0|lte:500|gte:50',
      'palette_dashboard_1' => 'starts_with:#|string|size:7',
      'palette_dashboard_2' => 'starts_with:#|string|size:7',
      'palette_dashboard_3' => 'starts_with:#|string|size:7',
      'palette_dashboard_4' => 'starts_with:#|string|size:7',
      'palette_dashboard_5' => 'starts_with:#|string|size:7',
      'palette_dashboard_6' => 'starts_with:#|string|size:7',
      'palette_dashboard_7' => 'starts_with:#|string|size:7',
      'palette_dashboard_8' => 'starts_with:#|string|size:7',
      'palette_dashboard_9' => 'starts_with:#|string|size:7',
      'palette_sidebar_1' => 'starts_with:#|string|size:7',
      'palette_sidebar_2' => 'starts_with:#|string|size:7',
      'palette_sidebar_3' => 'starts_with:#|string|size:7',
      'palette_sidebar_4' => 'starts_with:#|string|size:7',
      'palette_sidebar_5' => 'starts_with:#|string|size:7',
      'palette_sidebar_6' => 'starts_with:#|string|size:7',
      'palette_sidebar_7' => 'starts_with:#|string|size:7',
      'palette_sidebar_8' => 'starts_with:#|string|size:7',
      'palette_auth_1' => 'starts_with:#|string|size:7',
      'palette_auth_2' => 'starts_with:#|string|size:7',
      'palette_auth_3' => 'starts_with:#|string|size:7',
      'palette_auth_4' => 'starts_with:#|string|size:7',
      'palette_auth_5' => 'starts_with:#|string|size:7',
      'palette_auth_6' => 'starts_with:#|string|size:7',
      'palette_auth_7' => 'starts_with:#|string|size:7',
      'palette_auth_8' => 'starts_with:#|string|size:7',
      'keyboard_shortcuts' => 'boolean',
      'keybind_icons' => 'boolean',
      'sidebar_hover_tooltip' => 'numeric|decimal:0|lte:2|gte:0',
      'server_overview_graphs' => 'boolean',
      'server_colored_power' => 'boolean',
      'sidebar_always_visible_buttons' => 'boolean',
      'icon_fallback' => 'string|in:bootstrap,feather,lucide,material,material-light,fontawesome,eva-outline,eva-solid,remix-outline,remix-solid,tabler,octicons,akar-icons,hugeicons-solid,hugeicons-stroke',
      'dashboard_transparency' => 'numeric|decimal:0|lte:3|gte:0',
      'page_indexing' => 'boolean',
      'website_links' => 'boolean',
      'weblink_support' => 'string|nullable|url:http,https',
      'weblink_billing' => 'string|nullable|url:http,https',
      'weblink_status' => 'string|nullable|url:http,https',
      'weblink_social_discord' => 'string|nullable',
      'weblink_social_github' => 'string|nullable',
      'website_links_align' => 'boolean',
      'alert' => 'boolean',
      'alert_text' => 'string|nullable',
      'alert_icon' => 'string|in:megaphone-fill,exclamation-triangle-fill,check-circle-fill,database-fill,chat-square-text-fill,gear-fill,rocket-takeoff-fill,reception-4',
      'watermark_auth' => 'boolean',
      'server_list' => 'string|in:cards,list',
      'reset' => 'boolean',
      'border_radius' => 'numeric|decimal:0|lte:20|gte:0',
      'sidebar_full' => 'boolean',
      'sidebar_buttonstyle' => 'numeric|decimal:0|lte:2|gte:0',
      'sidebar_customlogo' => 'string|nullable|url:http,https',
      'auth_customlogo' => 'string|nullable|url:http,https',
      'alert_position' => 'string|in:sticky,static',
      'sidebar_border_radius' => 'numeric|decimal:0|lte:20|gte:0',
      'alert_dismiss' => 'boolean',
      'palette_status_offline' => 'starts_with:#|string|size:7',
      'palette_status_error' => 'starts_with:#|string|size:7',
      'palette_status_starting' => 'starts_with:#|string|size:7',
      'palette_status_online' => 'starts_with:#|string|size:7',
      'statusgradient_style' => 'string|in:default,flat',
      'sidebar_hover' => 'string|in:disabled,popout,expand',
      'animations' => 'string|in:fadeup,zoomout,fadein,disabled',
      'sidebar_separators' => 'boolean',
    ];
  }

  public function attributes(): array
  {
    return [
      'sidebar_home' => '(global) dashboard icon',
      'sidebar_admin' => '(global) admin icon',
      'sidebar_account' => '(global) account icon',
      'sidebar_logout' => '(global) logout icon',
      'sidebar_server_terminal' => '(server) terminal icon',
      'sidebar_server_files' => '(server) files icon',
      'sidebar_server_databases' => '(server) databases icon',
      'sidebar_server_schedules' => '(server) schedules icon',
      'sidebar_server_users' => '(server) users icon',
      'sidebar_server_backups' => '(server) backups icon',
      'sidebar_server_network' => '(server) network icon',
      'sidebar_server_startup' => '(server) startup icon',
      'sidebar_server_settings' => '(server) settings icon',
      'sidebar_server_activity' => '(server) activity icon',
      'sidebar_server_more' => '(server) more icon',
      'sidebar_account_account' => '(account) account icon',
      'sidebar_account_api' => '(account) api icon',
      'sidebar_account_ssh' => '(account) ssh icon',
      'sidebar_account_activity' => '(account) activity icon',
      'sidebar_account_more' => '(account) more icon',
      'icon_scale' => 'sidebar icon scale percentage',
      'watermark' => 'watermark toggle',
      'background_image' => 'dashboard background image',
      'sidebar_background' => 'sidebar background mode',
      'background_appearance' => 'dashboard background blur toggle',
      'background_magic' => 'dashboard background pattern type',
      'background_magicsize' => 'dashboard background pattern size',
      'auth_background_image' => 'authentication background image',
      'auth_background_appearance' => 'authentication background blur toggle',
      'auth_background_magic' => 'authentication background pattern type',
      'auth_background_magicsize' => 'authentication background pattern size',
      'palette_dashboard_1' => 'dashboard color palette value 1',
      'palette_dashboard_2' => 'dashboard color palette value 2',
      'palette_dashboard_3' => 'dashboard color palette value 3',
      'palette_dashboard_4' => 'dashboard color palette value 4',
      'palette_dashboard_5' => 'dashboard color palette value 5',
      'palette_dashboard_6' => 'dashboard color palette value 6',
      'palette_dashboard_7' => 'dashboard color palette value 7',
      'palette_dashboard_8' => 'dashboard color palette value 8',
      'palette_dashboard_9' => 'dashboard color palette value 9',
      'palette_sidebar_1' => 'sidebar color palette value 1',
      'palette_sidebar_2' => 'sidebar color palette value 2',
      'palette_sidebar_3' => 'sidebar color palette value 3',
      'palette_sidebar_4' => 'sidebar color palette value 4',
      'palette_sidebar_5' => 'sidebar color palette value 5',
      'palette_sidebar_6' => 'sidebar color palette value 6',
      'palette_sidebar_7' => 'sidebar color palette value 7',
      'palette_sidebar_8' => 'sidebar color palette value 8',
      'palette_auth_1' => 'authentication color palette value 1',
      'palette_auth_2' => 'authentication color palette value 2',
      'palette_auth_3' => 'authentication color palette value 3',
      'palette_auth_4' => 'authentication color palette value 4',
      'palette_auth_5' => 'authentication color palette value 5',
      'palette_auth_6' => 'authentication color palette value 6',
      'palette_auth_7' => 'authentication color palette value 7',
      'palette_auth_8' => 'authentication color palette value 8',
      'keyboard_shortcuts' => 'keyboard shortcuts toggle',
      'keybind_icons' => 'keyboard shortcuts toggle',
      'sidebar_hover_tooltip' => 'sidebar buttons hover tooltip',
      'server_overview_graphs' => 'server overview graphs',
      'server_colored_power' => 'server overview colored power buttons toggle',
      'sidebar_always_visible_buttons' => 'sidebar always visible category',
      'icon_fallback' => 'icon pack/theme',
      'dashboard_transparency' => 'element transparency',
      'page_indexing' => 'page indexing',
      'website_links' => 'website links',
      'weblink_support' => 'support weblink',
      'weblink_billing' => 'billing weblink',
      'weblink_status' => 'status weblink',
      'weblink_social_discord' => 'discord social weblink',
      'weblink_social_github' => 'github social weblink',
      'website_links_align' => 'website link align mode',
      'alert' => 'alert toggle',
      'alert_text' => 'alert content',
      'alert_icon' => 'alert icon',
      'watermark_auth' => 'authentication watermark toggle',
      'server_list' => 'server list style',
      'reset' => 'factory defaults',
      'border_radius' => 'element border radius',
      'sidebar_full' => 'full sidebar',
      'sidebar_buttonstyle' => 'sidebar button style',
      'sidebar_customlogo' => 'sidebar custom logo',
      'auth_customlogo' => 'authentication custom logo',
      'alert_position' => 'alert position',
      'sidebar_border_radius' => 'sidebar border radius',
      'alert_dismiss' => 'alert dismissable',
      'palette_status_offline' => 'status color palette value for offline',
      'palette_status_error' => 'status color palette value for error',
      'palette_status_starting' => 'status color palette value for starting',
      'palette_status_online' => 'status color palette value for online',
      'statusgradient_style' => 'server list status gradient style',
      'sidebar_hover' => 'sidebar button hover animation',
      'animations' => 'dashboard animation',
      'sidebar_separators' => 'sidebar separators',
    ];
  }
}