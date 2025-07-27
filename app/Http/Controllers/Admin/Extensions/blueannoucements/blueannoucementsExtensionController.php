<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\blueannoucements;

use Illuminate\View\View;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Helpers\SoftwareVersionService;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintExtensionLibrary;

class blueannoucementsExtensionController extends Controller {

  /**
   * blueannoucementsExtensionController constructor.
   */
  public function __construct(
    private BlueprintExtensionLibrary $blueprint,
    private SoftwareVersionService $version,
    private ViewFactory $view,
    private SettingsRepositoryInterface $settings,
    private ConfigRepository $config
  ){}

  /**
   * Return the extension index view.
   */
  public function index(): View
  {
    $status = $this->blueprint->dbGet('blueannoucements', 'status');
    $text = $this->blueprint->dbGet('blueannoucements', 'text');
    $fontcolour = $this->blueprint->dbGet('blueannoucements', 'fontcolor');
    $alertbodycolour = $this->blueprint->dbGet('blueannoucements', 'alertbodycolour');
    $hideable = $this->blueprint->dbGet('blueannoucements', 'hideable');
    $icon = $this->blueprint->dbGet('blueannoucements', 'icon');

    if($status == "") {
      $defaultDb_status = "true";
      $this->blueprint->dbSet('blueannoucements', 'status', "$defaultDb_status");
      $status = $this->blueprint->dbGet('blueannoucements', 'status');
    }

    if($hideable == "") {
      $defaultDb_hideable = "true";
      $this->blueprint->dbSet('blueannoucements', 'hideable', "$defaultDb_hideable");
      $db_hideable = $this->blueprint->dbGet('blueannoucements', 'hideable');
    }

    if($icon == "") {
      $defaultDb_icon = "true";
      $this->blueprint->dbSet('blueannoucements', 'icon', "$defaultDb_icon");
      $db_icon = $this->blueprint->dbGet('blueannoucements', 'icon');
    }

    if($text == "") {
      $defaultText = "Welcome to our panel!";
      $this->blueprint->dbSet('blueannoucements', 'text', "$defaultText");
      $text = $this->blueprint->dbGet('blueannoucements', 'text');
    }
    if($fontcolour == ""){
      $defaultFontcolor = "#fff";
      $this->blueprint->dbSet('blueannoucements', 'fontcolor', "$defaultFontcolor");
      $text = $this->blueprint->dbGet('blueannoucements', 'fontcolor');
    }
    if($alertbodycolour == ""){
        $defaultAlertbodycolour = "#FF7F7F";
        $this->blueprint->dbSet('blueannoucements', 'alertbodycolour', "$defaultAlertbodycolour");
        $text = $this->blueprint->dbGet('blueannoucements', 'alertbodycolour');
    }
    

    return $this->view->make('admin.extensions.blueannoucements.index', [
      'blueprint' => $this->blueprint,

      'db_status' => $status,
      'hideable' => $hideable,
      'icon' => $icon,
      'text' => $text,
      'fontcolor' => $fontcolour,
      'alertbodycolour' => $alertbodycolour,
      
      'version' => $this->version,
      'root' => "/admin/extensions/blueannoucements"
    ]);
  }

  /**
   * @throws \Pterodactyl\Exceptions\Model\DataValidationException
   * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
   */
  public function update(blueannoucementsSettingsFormRequest $request): RedirectResponse
  {
    foreach ($request->normalize() as $key => $value) {
      $this->settings->set('blueannoucements::' . $key, $value);
    }

    return redirect()->route('admin.extensions.blueannoucements.index');
  }
}

class blueannoucementsSettingsFormRequest extends AdminFormRequest
{
  public function rules(): array
  {
    return [
      'status' => 'string',
      'hideable' => 'string',
      'icon' => 'string',
      'text' => 'string',
      'fontcolor' => 'starts_with:#|string',
      'alertbodycolour' => 'starts_with:#|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'status' => 'BlueAnnoucements status toggle',
      'hideable' => 'BlueAnnoucements view toggle',
      'icon' => 'BlueAnnoucements icon toggle',
      'text' => 'BlueAnnoucements text',
      'fontcolor' => 'BlueAnnoucements Text Colour',
      'alertbodycolour' => 'BlueAnnoucements Alert Background Colour',
    ];
  }
}