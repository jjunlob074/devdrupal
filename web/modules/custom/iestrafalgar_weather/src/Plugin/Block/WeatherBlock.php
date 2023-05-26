<?php

namespace Drupal\iestrafalgar_weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\iestrafalgar_weather\OpenApiConnector;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a weather block.
 *
 * @Block(
 *   id = "iestrafalgar_weather_block",
 *   admin_label = @Translation("Weather Block"),
 *   category = @Translation("Custom Blocks")
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $openApiConnector;

  /**
   * Constructs a new WeatherBlock instances.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\iestrafalgar_weather\OpenApiConnector $open_api_connector
   *   The OpenApiConnector service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, OpenApiConnector $open_api_connector) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->openApiConnector = $open_api_connector;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('iestrafalgar_weather.openapi_connector')
    );
  }

  /**
   * {@inheritdoc}
   */
  // IMPLEMENTAR LA ESTÁTICA,ESTA METIDA DE FORMA INYECTADA ff
  public function build() {
    $weather= $this->openApiConnector->getWeather();

    return [
      '#theme' => 'iestrafalgar_weather_block',
      '#temperature' => $weather->temperature,
      '#windSpeed' => $weather->windSpeed,
      '#attached' => [
        'library' => [
          'iestrafalgar_weather/iestrafalgar_weather',
        ],
      ],
    ];
  }

}
