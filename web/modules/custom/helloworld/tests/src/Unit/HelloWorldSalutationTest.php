<?php

namespace Drupal\Tests\helloworld\Unit;


use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\helloworld\HelloWorldSalutation;
use Drupal\Tests\UnitTestCase;

class HelloWorldSalutationTest extends UnitTestCase {

  public function testSalutation(): void {

    //$fakeLanguageManager = $this->getMockBuilder(LanguageManager::class)->getMock();
    // Mock LanguageManager.
    $languageProphecy = $this->prophesize(LanguageInterface::class);
    $languageProphecy->getId()->willReturn('usa');

    $languageManagerProphecy = $this->prophesize(LanguageManagerInterface::class);
    $languageManagerProphecy->getCurrentLanguage()->willReturn($languageProphecy->reveal());
    $languageManagerMock = $languageManagerProphecy->reveal();
    $salutation = new HelloWorldSalutation($languageManagerMock);
    $salutation->setStringTranslation($this->getStringTranslationStub());

    self::assertEquals('Good evening world es', $salutation->getSalutation());

  }

}
