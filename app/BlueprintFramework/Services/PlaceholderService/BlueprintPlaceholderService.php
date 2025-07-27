<?php

namespace Pterodactyl\BlueprintFramework\Services\PlaceholderService;

class BlueprintPlaceholderService
{
  public function version(): string
  {
    return "beta-2024-12";
  }
  public function folder(): string
  {
    return base_path();
  }
  public function installed(): string
  {
    return "INSTALLED";
  }
  public function api_url(): string
  {
    return "https://api.blueprintframe.work";
  }
}
