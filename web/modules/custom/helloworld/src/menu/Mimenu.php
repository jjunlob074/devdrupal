<?php

namespace Drupal\helloworld\menu;

use Drupal\Core\Menu\MenuLinkTreeInterface;

class Mimenu {

  protected $menuLinkTree;

  public function __construct(MenuLinkTreeInterface $menuLinkTree) {
    $this->menuLinkTree = $menuLinkTree;
  }

  public function myMethod() {
    $parameters = $this->menuLinkTree->getCurrentRouteMenuTreeParameters('main');
    $tree = $this->menuLinkTree->load('main', $parameters);
    // procesar el árbol de enlaces de menú aquí
    return $tree;
  }

}
