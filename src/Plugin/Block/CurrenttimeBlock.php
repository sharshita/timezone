<?php

namespace Drupal\timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with Current time.
 *
 * @Block(
 *   id = "currenttime_block",
 *   admin_label = @Translation("Current time"),
 * )
 */
class CurrenttimeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {
    $service = \Drupal::service('timezone.data');    
    $data =  $service->get_time();    
    return [
      '#theme' => 'timezone_block_template',
      '#current_time' => $data['time'],
      '#current_city' => $data['city'],
      '#current_country' => $data['country'],
      '#time' => $data['today'],
      '#timezone' => $data['timezone']
    ];
  
  }

  public function getCacheMaxAge() {
    return 0;
  }

}