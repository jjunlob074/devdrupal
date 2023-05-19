<?php

/**
 * @file
 * Provide site administrators with a list of all the RSVP List signups
 * so they know who is attending their events.
 */

namespace Drupal\rsvplist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
class ReportController extends ControllerBase {
  /**
   * DEVUELVE TODOS LOS RSVP DE TODOS LOS NODOS
   * @return array|null
   */
  protected function load() {
    try {
      $database = \Drupal::database();
      $select_query = $database->select('rsvplist','r');

      // QUERRYS QUE RELACIONAN LA TABLA RSVPLIST CON LOS DATOS DE USUARIOS Y NODOS
      $select_query->join('users_field_data','u','r.uid=u.uid');
      $select_query->join('node_field_data','n','r.nid=n.nid');
      // AÑADE CAMPOS A LA VARIABLE
      $select_query->addField('u','name','username');
      $select_query->addField('n','title');
      $select_query->addField('r','mail');

      $entries = $select_query->execute()->fetchAll(\PDO::FETCH_ASSOC);

      return $entries;
    }
    catch (\Exception $e) {
    \Drupal::messenger()->addStatus(
      t('Unable to access the database at this time. Please try again later.')
    );
    return NULL;
    }
  }

  /**
   * Creates the RSVPList report page
   *
   * @return array
   *  Render array for the RSVPList report output
   */
  public function report() {
    // MIRAR INFORMACIÓN EN EL VIDEO 31 DEL CURSO ACQUIA DEV
    $content = [];
    $content['message'] = [
      '#markup' => t('Below is a list of all Event RSVPs including username,
      email, adress and the name of the event they will be attending.')
    ];

    $headers = [
      t('Username'),
      t('Name of content'),
      t('Email'),
    ];

    $table_rows= $this->load();

    $content['table'] = [
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $table_rows,
      '#empty' => t('No entries available.'),
    ];

    $content['#cache']['max-age'] = 0;

    return $content;
  }
}
