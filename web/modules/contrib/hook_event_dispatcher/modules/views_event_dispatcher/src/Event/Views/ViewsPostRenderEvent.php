<?php

namespace Drupal\views_event_dispatcher\Event\Views;

use Drupal\views\Plugin\views\cache\CachePluginBase;
use Drupal\views\ViewExecutable;
use Drupal\views_event_dispatcher\ViewsHookEvents;

/**
 * Class ViewsPostRenderEvent.
 *
 * @HookEvent(id="views_post_render", hook="views_post_render")
 */
class ViewsPostRenderEvent extends AbstractViewsEvent {

  /**
   * A renderable array containing the output of the view.
   *
   * @var array
   */
  private array $output = [];

  /**
   * ViewsPreExecuteEevent constructor.
   *
   * @param \Drupal\views\ViewExecutable $view
   *   The view object about to be processed.
   * @param string $output
   *   A flat string with the rendered output of the view.
   * @param \Drupal\views\Plugin\views\cache\CachePluginBase $cache
   *   The cache settings.
   */
  public function __construct(ViewExecutable $view, &$output, private CachePluginBase $cache) {
    parent::__construct($view);
    $this->output = &$output;
  }

  /**
   * Get the cache settings.
   *
   * @return \Drupal\views\Plugin\views\cache\CachePluginBase
   *   The cache settings.
   */
  public function getCache(): CachePluginBase {
    return $this->cache;
  }

  /**
   * Get the output render array.
   *
   * @return array
   *   A renderable array containing the output of the view.
   *
   * @see https://www.drupal.org/project/drupal/issues/2793169
   *   Drupal core issue regarding $output being documented as a string when it
   *   is in fact a render array.
   */
  public function &getOutput(): array {
    return $this->output;
  }

  /**
   * {@inheritdoc}
   */
  public function getDispatcherType(): string {
    return ViewsHookEvents::VIEWS_POST_RENDER;
  }

}