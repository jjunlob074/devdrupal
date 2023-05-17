<?php

namespace Drupal\helloworld\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\helloworld\menu\Mimenu;
/**
 * Hello World Salutation block.
 *
 * @Block(
 *   id = "helloworld_menu",
 *   admin_label = @Translation("Helloworld_menu"),
 * )
 */
class MyMenuBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The menu service.
   *
   * @var \Drupal\helloworld\menu\Mimenu
   */
  protected $menu;

  /**
   * Constructs a MyMenuBlock instance.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The plugin_id for the block.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\helloworld\menu\Mimenu $menu
   *   The menu service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, Mimenu $menu) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->menu = $menu;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('helloworld.mimenu')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $enabled = $config['enabled'];
    if ($enabled) {

      // Inyectado.
      //$tree = $this->menu->myMethod();

      // No inyectado.

      //$tree = $menu->myMethod();

      // Use $tree to build your menu.
      // For example, you could use the following code:
      return [
        // EL PROBLEMA ESTÁ EN LAS LINEAS COMENTADAS, ALGO NO ESTÁ PINTANDO BIEN, EL MARKUP LO PILLA
//        '#theme' => 'menu_tree',
//        '#menu_name' => 'helloworld.salutation',
//        '#tree' => $tree,
          '#markup' => t(\Drupal::languageManager()->getCurrentLanguage()->getId()),
      ];
    }
    else {
      return [
        '#markup' => $this->t('The block is disabled.'),
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'enabled' => 1,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable the block'),
      '#default_value' => $config['enabled'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['enabled'] = $form_state->getValue('enabled');
  }

}
