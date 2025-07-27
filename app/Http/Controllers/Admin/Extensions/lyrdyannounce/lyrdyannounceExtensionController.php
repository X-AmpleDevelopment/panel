<?php

namespace Pterodactyl\Http\Controllers\Admin\Extensions\lyrdyannounce;

use Illuminate\View\View;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Http\Requests\Admin\AdminFormRequest;
use Illuminate\Http\RedirectResponse;

// https://blueprint.zip/docs/?page=documentation/$blueprint
use Pterodactyl\BlueprintFramework\Libraries\ExtensionLibrary\Admin\BlueprintAdminLibrary as BlueprintExtensionLibrary;

class lyrdyannounceExtensionController extends Controller
{
  public function __construct(
    private ViewFactory $view,
    private BlueprintExtensionLibrary $blueprint,
    private ConfigRepository $config,
    private SettingsRepositoryInterface $settings,
  ) {}
  
  public function index(): View
  {

    // GET DATABASE VALUES
    $user_id = $this->blueprint->dbGet('lyrdyannounce', 'user_id');
    $toggle = $this->blueprint->dbGet('lyrdyannounce', 'enable');

        
    // APPLY DEFAULT DATABASE VALUES
    if($user_id == "") { $this->blueprint->dbSet('lyrdyannounce', 'user_id', "usr_test_1234567890"); $user_id = 'usr_test_1234567890'; };
    if($toggle == "") { $this->blueprint->dbSet('lyrdyannounce', 'enable', "true"); $toggle = 'true'; };

    return $this->view->make(
      'admin.extensions.lyrdyannounce.index', [
        'user_id' => $user_id,
        'toggle' => $toggle,

        'root' => "/admin/extensions/lyrdyannounce",
        'blueprint' => $this->blueprint,
      ]
    );
  }
  /**
   * @throws \Pterodactyl\Exceptions\Model\DataValidationException
   * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
   */
  public function update(lyrdyannounceSettingsFormRequest $request): RedirectResponse
  {
    foreach ($request->normalize() as $key => $value) {
      $this->settings->set('lyrdyannounce::' . $key, $value);
    }

    return redirect()->route('admin.extensions.lyrdyannounce.index');
  }
}
class lyrdyannounceSettingsFormRequest extends AdminFormRequest
{
  public function rules(): array
  {
    /* 
      Learn more about Laravel input validation:
      https://laravel.com/docs/10.x/validation#available-validation-rules
    */
    return [
      'user_id' => ['regex:/^(team|usr)_[0-9a-f]{32}$/i'],
      'enable' => ['string', 'in:true,false'],
    ];
  }

  public function attributes(): array
  {
    return [
      'user_id' => 'identifier',
      'enable' => 'Toggle switch',
    ];
  }
}
