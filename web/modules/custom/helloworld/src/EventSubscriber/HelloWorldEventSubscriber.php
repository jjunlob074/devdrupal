<?php

namespace Drupal\helloworld\EventSubscriber;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\core_event_dispatcher\EntityHookEvents;
use Drupal\core_event_dispatcher\Event\Entity\EntityPresaveEvent;
use Drupal\node\NodeInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber for act node type related stuff.
 */
class HelloWorldEventSubscriber implements EventSubscriberInterface {

  use StringTranslationTrait;

  /**
   * @param \Drupal\core_event_dispatcher\Event\Entity\EntityPresaveEvent $event
   */
  public function entityPreSave(EntityPresaveEvent $event): void {

   $entity = $event->getEntity();

   if (
     !$entity instanceof NodeInterface
     || (
       $entity instanceof NodeInterface
       && $entity->bundle() != 'listado_de_cuadro'
     )
   ) {
     return;
   }

   $_AUTHOR_FIELD_NAME = 'field_autor';

   if (!$entity->hasField($_AUTHOR_FIELD_NAME)) {
     return;
   }

   if ($entity->get($_AUTHOR_FIELD_NAME)->isEmpty()) {
     $entity->set($_AUTHOR_FIELD_NAME, 'Sin autor');
   }

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    return [
      EntityHookEvents::ENTITY_PRE_SAVE => 'entityPreSave',
    ];
  }

}
