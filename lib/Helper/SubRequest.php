<?php
namespace Drupal\at_base\Helper;

/**
 * Usage:
 * @code
 *   at_id(new Drupal\at_base\Helper\SubRequest('atest_theming/users'))->request();
 * @code
 */
class SubRequest {
  private $path;
  private $original_path;

  /**
   * @param string $path
   */
  public function __construct($path) {
    $this->path = $path;
    $this->original_path = $_GET['q'];
    $_GET['q'] = $path;
  }

  public function __destruct() {
    $_GET['q'] = $this->original_path;
  }

  public function request() {
    return menu_execute_active_handler($this->path, $deliver = FALSE);
  }
}
