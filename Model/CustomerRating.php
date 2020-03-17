<?php
namespace Hatslogic\ExperienceSurvey\Model;

use Magento\Framework\Model\AbstractModel;

class CustomerRating extends AbstractModel
{
	protected function _construct()
	{
		$this->_init('Hatslogic\ExperienceSurvey\Model\ResourceModel\CustomerRating');
	}
}