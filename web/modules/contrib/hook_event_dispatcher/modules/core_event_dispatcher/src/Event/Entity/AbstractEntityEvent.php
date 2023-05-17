<?php

namespace Drupal\core_event_dispatcher\Event\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\hook_event_dispatcher\Event\EventInterface;
use Drupal\Component\EventDispatcher\Event;

/**
 * Class AbstractEntityEvent.
 */
abstract class AbstractEntityEvent extends Event implements EventInterface {

  /**
   * AbstractEntityEvent constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The Entity.
   */
  public function __construct(protected EntityInterface $entity) {
  }

  /**
   * Get the Entity.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   The Entity.
   */
  public function getEntity(): EntityInterface {
    return $this->entity;
  }

}
