<?php
namespace Drupal\Tests\iestrafalgar_weather\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\iestrafalgar_weather\OpenApiConnector;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Response;


class OpenApiConnectorTest extends UnitTestCase{
  public function testGetWeather(): void {
    // Crea un controlador de Guzzle para las solicitudes HTTP.
    $mockHandler = new MockHandler([
      new Response(200, [], '{"current_weather": {"temperature": 100, "windspeed": 200}}'),
    ]);
    $handlerStack = HandlerStack::create($mockHandler);

    // Crea una instancia del cliente HTTP de Guzzle con el controlador personalizado.
    $httpClient = new GuzzleHttpClient(['handler' => $handlerStack]);
    $openApiConnector = new OpenApiConnector($httpClient);


    $weather = $openApiConnector->getWeather();

    self::assertEquals(['temperature' => 100, 'windSpeed' => 200], $weather);
  }
}
