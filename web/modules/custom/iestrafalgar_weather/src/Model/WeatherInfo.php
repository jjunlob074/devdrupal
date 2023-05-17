<?php
namespace Drupal\iestrafalgar_weather\Model;
 class WeatherInfo {

  public ?float $temperature;
  public ?float $windSpeed;

  public function __construct(?float $temperature, ?float $windSpeed) {

    $this->temperature = $temperature;
    $this->windSpeed = $windSpeed;

  }

}
