<?php

namespace Hatslogic\ExperienceSurvey\Block\Adminhtml\Widget\OrderReviews\Column\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Asset\Repository;

class Rating extends AbstractRenderer
{
    /**
     * @var Registry
     */
    protected $registry;
    
    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;
    
    protected $_assetRepo;

    /**
     * Manufacturer constructor.
     * @param AttributeFactory $attributeFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Registry $registry,
        AttributeFactory $attributeFactory,
        Repository $_assetRepo,
        Context $context,
        array $data = array()
    )
    {
        $this->attributeFactory = $attributeFactory;
        $this->_assetRepo = $_assetRepo;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Renders grid column
     *
     * @param \Magento\Framework\DataObject $row
     * @return mixed
     */
    public function _getValue(\Magento\Framework\DataObject $row)
    {
        // Get default value:
        $value = parent::_getValue($row);
        return "<img title='".$value."' alt='".$value."' width='50px' height='50px' src='".$this->_assetRepo->getUrl("Hatslogic_ExperienceSurvey::images/icons/".$value.".png")."'/>";
    }
}