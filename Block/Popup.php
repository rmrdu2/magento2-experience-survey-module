<?php

namespace Hatslogic\ExperienceSurvey\Block;
use Hatslogic\ExperienceSurvey\Model\CustomerRating;

class Popup extends \Magento\Framework\View\Element\Template
{
    protected $_customerRating;

    protected $helperData;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Hatslogic\ExperienceSurvey\Helper\Data $helperData,
        CustomerRating $customerRating,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_customerRating = $customerRating;
        $this->helperData = $helperData;
    }

    /**
     * Get form action URL for POST survey
     *
     * @return string
     */
    public function getAjaxUrl()
    {
            // hatslogic is given in routes.xml
            // popup is folder name inside controller folder
            // save is php file name inside above popup folder

        return '/hatslogic/popup/save';
        
    }

     /**
     * Get Customer Email From Last Order
     *
     * @return string
     */
    public function getLastOrderCustomerEmail()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $orderDatamodel = $objectManager->get('Magento\Sales\Model\Order')->getCollection()->getLastItem();
        $customerEmail   =   $orderDatamodel->getCustomerEmail();

        return $customerEmail;
    }

    /**
     * Is Customer Already added a rating.
     *
     * @return string
     */
    public function isEmailExists()
    {
        $lastOrderCustomerEmail = $this->getLastOrderCustomerEmail(); 
        $data = $this->_customerRating->getCollection()->addFieldToFilter('customer_email', $lastOrderCustomerEmail);
       
        if(count($data->getData()) ){
            return true;
        }

        return false;
    }

    /**
    * @return bool
    */

    public function isEnabled()
    {
        return $this->helperData->getGeneralConfig('enable');
    }
    
}
