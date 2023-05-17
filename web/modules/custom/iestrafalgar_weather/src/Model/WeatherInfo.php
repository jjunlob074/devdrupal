<?php
 class WeatherInfo {

  public ?int $temperature;
  public ?int $windSpeed;

  public function __construct(?int $temperature, ?int $windSpeed) {

    $this->temperature = $temperature;
    $this->windSpeed = $windSpeed;

  }

}
