<?php
namespace Drupal\at_base\Helper;

class ModuleFetcher {
  private $base_module;
  private $config_file;

  public function __construct($base_module, $config_file) {
    $this->base_module = $base_module;
    $this->config_file = $config_file;
  }

  public function fetch() {
    $modules[] = $this->base_module;
    foreach (system_list('module_enabled') as $module_name => $module_info) {
    }
    return $modules;
  }

  private function validateModule($module_name, $module_info) {
    if (empty($module_info->info['dependencies'])) return FALSE;
    if (!in_array($this->base_module, $module_info->info['dependencies'])) return FALSE;

    // Do no need checking config file
    if (empty($this->config_file)) return TRUE;

    // Config file is available
    $file = DRUPAL_ROOT . '/' . drupal_get_path('module', $module_name) . '/config/'. $this->config_file .'.yml';
    if (is_file($file)) return TRUE;

    return FALSE;
  }
}