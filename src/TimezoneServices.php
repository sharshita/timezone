<?php
namespace  Drupal\timezone;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatter;
/**
* @file providing the service that return the current time based on the time zone selection.
*
*/

class TimezoneServices {
 
  /**
   * The config factory object.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
   /**
   * The Date Fromatter.
   *
   * @var Drupal\Core\Datetime\DateFormatter
   */
  protected $date_formatter;

  /**
   * Constructs a ServiceExample object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   A configuration factory instance.
   */
  public function __construct(ConfigFactoryInterface $config_factory, DateFormatter $date_formatter) {
    $this->configFactory = $config_factory;
    $this->date_formatter = $date_formatter;
  }

 public function get_time() {
    $config = $this->configFactory->get('timezone.adminsettings');
    $time = $config->get('timezone');
    $country = $config->get('country');
    $city = $config->get('city');
    $todaydate = \Drupal::time()->getCurrentTime();
    $currenttime = $this->date_formatter->format($todaydate, 'custom', 'h:i A', $time);
    $data = ['time'=>$currenttime,
            'city' => $city,
            'country' => $country,
            'today' => $todaydate,
            'timezone' => $time
        ];
    return $data;
 }
 
}