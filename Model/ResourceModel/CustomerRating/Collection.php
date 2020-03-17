<?php
namespace Hatslogic\ExperienceSurvey\Model\ResourceModel\CustomerRating;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init(
			'Hatslogic\ExperienceSurvey\Model\CustomerRating', 
			'Hatslogic\ExperienceSurvey\Model\ResourceModel\CustomerRating'
		);
	}

}