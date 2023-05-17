<?php
namespace Drupal\helloworld\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\helloworld\HelloWorldSalutation;


class SalutationController extends ControllerBase {
//public function content() {
//  $salutation = \Drupal::service('helloworld.salutation');
//
//    return [
//      '#markup' => $salutation->getSalutation(),
//    ];
//
//}
  /**
   * @var \Drupal\helloworld\HelloWorldSalutation
   */
  protected $salutation;
  /**
   * HelloWorldSalutationController constructor.
   *
   * @param \Drupal\helloworld\HelloWorldSalutation $salutation
   */
  public function __construct(HelloWorldSalutation $salutation) {
    $this->salutation = $salutation;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('helloworld.salutation')
    );
  }
public function salutation(){
  return [
    '#theme' => 'helloworld_salutation',
    '#salutation' => $this->salutation->getSalutation(),
    '#variables' => [
      '#nombre2' => 'Víctor',
    ],
  ];
}
}
