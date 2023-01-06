<?php  
  
/**  
 * @file  
 * Contains Drupal\timezone\Form\TimezoneForm.  
 */  
  
namespace Drupal\timezone\Form;  
  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class TimezoneForm extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'timezone.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'timezone_form';  
  }
  
  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('timezone.adminsettings');  
    $form = parent::buildForm($form, $form_state);
    $form['country'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('Country'),  
      '#description' => $this->t('Add country name for which you want to set timezone'),  
      '#default_value' => $config->get('country'),  
    ];
    $form['city'] = [  
      '#type' => 'textfield',  
      '#title' => $this->t('City'),  
      '#description' => $this->t('Add city name for which you want to set timezone'),  
      '#default_value' => $config->get('city'),  
    ];
    $form['timezone'] = [
      '#title' => $this->t('Timezone'),
      '#type' => 'select',
      '#description' => "Select the timezone.",
      '#options' => ['America/Chicago' => $this->t('America/Chicago'),
                    'America/New_York' => $this->t('America/New_York'),
                    'Asia/Tokyo' => $this->t('Asia/Tokyo'),
                    'Asia/Dubai' => $this->t('Asia/Dubai'),
                    'Asia/Kolkata' => $this->t('Asia/Kolkata'),
                    'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
                    'Europe/Oslo' => $this->t('Europe/Oslo'),
                    'Europe/London' => $this->t('Europe/London')
                    ],
      '#default_value' => $config->get('timezone'),            
    ];  
  
    return $form;
  }
  
  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('timezone.adminsettings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))      
      ->set('timezone', $form_state->getValue('timezone'))  
      ->save();  
  }  
}  