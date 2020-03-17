<?php
namespace Hatslogic\ExperienceSurvey\Block\Adminhtml;

class OrderReviews extends  \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'hatslogicexperiencesurvey_index';
		$this->_blockGroup = 'Hatslogic_ExperienceSurvey';
		
        parent::_construct();
        $this->removeButton('add');
	}
}