<?php

namespace Drupal\helloworld\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;


/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {

  /**
   * Hello.
   *
   * @return array
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('<h2>Hello World (Example Drupal 8 Controller) code:</h2>')
        . '<code><?php<br>namespace Drupal\helloworld\Controller;<br>'
        . 'use Drupal\Core\Controller\ControllerBase;<br><br>'
        . 'class DefaultController extends ControllerBase {<br>'
        . '&nbsp;&nbsp;public function hello() {<br>'
        . '&nbsp;&nbsp;&nbsp;&nbsp;return [<br>'
        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'#type\' => \'markup\',<br>'
        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\'#markup\' => $this->t(\'Hello World (Example Drupal 8 Controller) code!\')<br>'
        . '&nbsp;&nbsp;&nbsp;&nbsp;];<br>&nbsp;&nbsp;}<br>}</code>'
        . Url::fromRoute('helloworld.default_controller_hello')->toString(),
    ];
  }

  protected $menuLinkTree;

  public function menu() {
    $parameters = $this->menuLinkTree->getCurrentRouteMenuTreeParameters('helloworld.menu');
    $tree = $this->menuLinkTree->load('helloworld.salutation', $parameters);

    $menu = array();
    foreach ($tree as $item) {
      $menu[] = array(
        'title' => $item->title,
        'url' => $item->link->getUrlObject()->setAbsolute()->toString(),
      );
    }

    return array(
      '#theme' => 'item_list',
      '#items' => $menu,
      '#title' => 'Hello World Menu',
    );
  }

}
