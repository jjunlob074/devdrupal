<?php
namespace Drupal\Tests\iestrafalgar_weather\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\iestrafalgar_weather\OpenApiConnector;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;


class OpenApiConnectorTest extends UnitTestCase{
  public function testGetWeather(): void {
//    // Crea un controlador de Guzzle para las solicitudes HTTP.
//    $mockHandler = new MockHandler([
//      new Response(200, [], '{"current_weather": {"temperature": 100, "windspeed": 200}}'),
//    ]);
//    $handlerStack = HandlerStack::create($mockHandler);
//
//    // Crea una instancia del cliente HTTP de Guzzle con el controlador personalizado.
//    $httpClient = new GuzzleHttpClient(['handler' => $handlerStack]);


    $bodyMock = $this->createStub(StreamInterface::class);
    $bodyMock->method('getContents')->willReturn('{"current_weather": {"temperature": 100, "windspeed": 200}}');

    $responseMock = $this->createStub(ResponseInterface::class);
    $responseMock->method('getBody')->willReturn($bodyMock);

    $clientMock = $this->createStub(Client::class);
    $clientMock->method('get')->willReturn($responseMock);

    $openApiConnector = new OpenApiConnector($clientMock);



    $weather = $openApiConnector->getWeather();

    self::assertEquals(100, $weather->temperature);
    self::assertEquals(200, $weather->windSpeed);
  }
}
