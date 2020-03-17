<?php

namespace Hatslogic\ExperienceSurvey\Controller\Popup;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Hatslogic\ExperienceSurvey\Model\CustomerRatingFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    
    
	/**
     * @var CustomerRating
     */
    protected $_customerRating;

    public function __construct(
        Context $context,
        CustomerRatingFactory $customerRating
    ){
        $this->_customerRating = $customerRating;
        parent::__construct($context);
    }
    /**
     * Save rating action
     *
     * @return void
     */
    public function execute()
    {
        // 1. POST request : Get popup data
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {
            // Retrieve your form data
            try {
                $model = $this->_customerRating->create();
                
                if (!\Zend_Validate::is(trim($post['rating']), 'NotEmpty')) {
                    throw new \Exception("Rating is required");
                }
                if (!\Zend_Validate::is(trim($post['rating']), 'NotEmpty')) {
                    throw new \Exception("Email is required");
                }
                if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    throw new \Exception("Not a valid Email");
                }

                

                $model->addData([
                    "customer_email" => $post['email'],
                    "rating" => $post['rating'],
                    "comment" => $post['comment']
                ]);

                $saveData = $model->save();

                if ($saveData) {
                    $response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData([
                    'status'  => "ok",
                    'message' => "Your rating added success fully"
                ]);

                    return $response;
                }
            }catch (\Exception $e) {
                
                $response = $this->resultFactory
                ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
                ->setData([
                    'status'  => "error",
                    'message' => $e->getMessage()
                ]);
                return $response;
            }
        }


        $response = $this->resultFactory
        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
        ->setData([
            'status'  => "error",
            'message' => "Invalid form data"
        ]);

        return $response;
    }
}