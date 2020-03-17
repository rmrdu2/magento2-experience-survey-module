<?php
namespace  Hatslogic\ExperienceSurvey\Block\Adminhtml;
use Magento\Backend\Block\Template;


class Index extends  Template
{
    
    
    protected $helperData;
    protected $orderFactory;

    public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Hatslogic\ExperienceSurvey\Helper\Data $helperData,
            \Magento\Sales\Model\OrderFactory $orderFactory
    ) { 
        parent::__construct($context);
        $this->helperData = $helperData;
        $this->orderFactory = $orderFactory;
    }
    
    public function getAnalytics()
    {
        $dropdownValues  = $this->helperData->getGeneralConfig('display_options');
        $display_options = explode(";",$dropdownValues);
        
       //$items[]         = ["value" => '' , "label" => 'Select' ];
        foreach( $display_options as $option){
            
            $orders = $this->orderFactory->create()->getCollection()->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'experience_survey_option',
                $option
            )->setOrder(
                'created_at',
                'desc'
            );
            $color = substr(md5(rand()), 0, 6);
            $items[] = ["value" => $option , "label" => $option,"count" => count($orders),"color" => "#".$color];
        }
    
       return $items;
    }

    // public function getAnalytics()
    // {
    //     $dropdownValues  = $this->helperData->getGeneralConfig('display_options');
    //     $display_options = explode(";",$dropdownValues);
        
    //    //$items[]         = ["value" => '' , "label" => 'Select' ];
    //     foreach( $display_options as $option){
            
    //         $orders = $this->orderFactory->create()->getCollection()->addFieldToSelect(
    //             '*'
    //         )->addFieldToFilter(
    //             'experience_survey_option',
    //             $option
    //         )->setOrder(
    //             'created_at',
    //             'desc'
    //         );
    //         $color = substr(md5(rand()), 0, 6);
    //         $items[] = ["value" => $option , "label" => $option,"count" => count($orders),"color" => "#".$color];
    //     }
    
    //    return $items;
    // }
}