<?php
namespace Hatslogic\ExperienceSurvey\Model\ResourceModel;


class CustomerRating extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	/**
     * Define main table
     */
	protected function _construct()
	{
		$this->_init('hatslogic_experiencesurvey', 'id');
	}
	
}