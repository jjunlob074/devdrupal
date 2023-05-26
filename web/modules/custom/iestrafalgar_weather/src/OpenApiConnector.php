<?php

namespace Drupal\iestrafalgar_weather;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\iestrafalgar_weather\Model\WeatherInfo;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides a weather from the API
 */


class OpenApiConnector implements ContainerInjectionInterface{

  protected Client $httpClient;

  public function __construct(Client $httpClient) {
    $this->httpClient = $httpClient;

  }

  public function getWeather() {
    // Realiza la llamada al API y obtén los datos necesarios.
    $response = $this->httpClient->get('https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&current_weather=true&windspeed_unit=kmh&temperature_unit=celsius');
    $data = $response->getBody()->getContents();

    // Parsea los datos y rellena el array de respuesta.
    $weatherData = json_decode($data, true);

    $weather = new WeatherInfo(
       $weatherData['current_weather']['temperature'],$weatherData['current_weather']['windspeed']
     );

    return $weather;
  }
// un comentario
  public static function create(ContainerInterface $container) {
    return new static ($container->get('http_client'));
  }

}

