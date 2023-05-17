<?php

namespace Drupal\views_event_dispatcher\Event\Views;

use Drupal\hook_event_dispatcher\Event\EventInterface;
use Drupal\views\ViewExecutable;
use Drupal\Component\EventDispatcher\Event;

/**
 * Class AbstractViewsEvent.
 */
abstract class AbstractViewsEvent extends Event implements EventInterface {

  /**
   * AbstractViewsEvent constructor.
   *
   * @param \Drupal\views\ViewExecutable $view
   *   The view.
   */
  public function __construct(private ViewExecutable $view) {
  }

  /**
   * Get the view.
   *
   * @return \Drupal\views\ViewExecutable
   *   The view.
   */
  public function getView(): ViewExecutable {
    return $this->view;
  }

}
