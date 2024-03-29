<?php
namespace  Hatslogic\ExperienceSurvey\Model\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddHtmlToOrderShippingViewObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager)
    {
        $this->_objectManager = $objectmanager;
    }

    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view')
        {
            $orderShippingViewBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();
            

            $experienceSurveyOptionBlock = $this->_objectManager->create('Magento\Framework\View\Element\Template');
            $experienceSurveyOptionBlock->setExperienceSurveyOption($order->getExperienceSurveyOption());
            $experienceSurveyOptionBlock->setTemplate('Hatslogic_ExperienceSurvey::order_info_shipping_info.phtml');
            $html = $observer->getTransport()->getOutput() . $experienceSurveyOptionBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }

}