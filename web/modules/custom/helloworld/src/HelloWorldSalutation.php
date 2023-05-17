<?php

namespace Drupal\helloworld;

use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepares the salutation to the world.
 */
class HelloWorldSalutation {
  use StringTranslationTrait;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * HelloWorldSalutation constructor.
   *
   * @param \Drupal\Core\Language\LanguageManagerInterface $languageManager
   *   The language manager.
   */
  public function __construct(LanguageManagerInterface $languageManager) {
    $this->languageManager = $languageManager;
  }

  /**
   * Returns the salutation.
   */
  public function getSalutation() {

    $langcode = $this->languageManager->getCurrentLanguage()->getId();

    $time = new \DateTime();
    if ((int) $time->format('G') >= 0 && (int) $time->format('G') < 12) {
      return $this->t('Good morning world') . ' ' . $langcode;
    }
    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Good afternoon world') . ' ' . $langcode;
    }
    if ((int) $time->format('G') >= 18) {
      return $this->t('Good evening world') . ' ' . $langcode;
    }

    return 0;
  }
}
