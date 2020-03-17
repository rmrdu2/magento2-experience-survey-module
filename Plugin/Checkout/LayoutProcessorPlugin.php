<?php
/**
* *
*  @author Hatslogic Team
*  @copyright Copyright (c) 2020 Hatslogic (https://www.2hatslogics.com)
*  @package Hatslogic_ExperienceSurvey
*/

namespace Hatslogic\ExperienceSurvey\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
* Class LayoutProcessorPlugin
* @package Hatslogic\ExperienceSurvey\Plugin\Checkout
*/
class LayoutProcessorPlugin
{
   
  protected $helperData;
  
  public function __construct(\Hatslogic\ExperienceSurvey\Helper\Data $helperData) {
        $this->helperData = $helperData;
  }
  /**
    * @param LayoutProcessor $subject
    * @param array $jsLayout
    * @return array
    */
   public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject,array $jsLayout) {

       
       if ($this->isEnabled()) {
           
        $customAttributeCode = 'experience_survey_option';
           $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress.experience_survey_option',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'drop-down',
            ],
            'dataScope' => 'shippingAddress.experience_survey_option',
            'label' => $this->getSelectLabel(),
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => ['required-entry' => true],
            'sortOrder' => 150,
            'id' => 'drop-down',
            'options' => $this->getSelectOptions()
        ];

           $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;
       }
        return $jsLayout;
   }

   /**
    * @return array
   */

   protected function getSelectOptions()
   {
        
        $dropdownValues  = $this->helperData->getGeneralConfig('display_options');
        $display_options = explode(";",$dropdownValues);
        $items[]         = ["value" => '' , "label" => 'Select' ];
        foreach( $display_options as $option){
            $items[] = ["value" => $option , "label" => $option ];
        }
    
       return $items;
   }

   /**
    * @return bool
   */

  protected function isEnabled()
  {
    return $this->helperData->getGeneralConfig('enable');
  }


  /**
    * @return string
   */

  protected function getSelectLabel()
  {
    return $this->helperData->getGeneralConfig('display_label');
  }


}