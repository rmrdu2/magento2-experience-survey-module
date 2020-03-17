<?php
/**
* *
*  @author Hatslogic Team
*  @copyright Copyright (c) 2020 Hatslogic (https://www.2hatslogic.com)
*  @package Hatslogic_ExperienceSurvey
*/
namespace Hatslogic\ExperienceSurvey\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
/**
* Class InstallSchema
* @package Hatslogic\ExperienceSurvey\Setup
*/
class InstallSchema implements InstallSchemaInterface
{
   /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
   public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
   {
       $installer = $setup;
       $installer->startSetup();
       /* While module install, creates columns in quote_address and sales_order_address table */
       $eavTable1 = $installer->getTable('quote');
       $eavTable2 = $installer->getTable('sales_order');
       $columns = [
           'experience_survey_option' => [
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
               'nullable' => true,
               'comment' => 'Select option',
           ],
       ];
       $connection = $installer->getConnection();
       foreach ($columns as $name => $definition) {
          $connection->addColumn($eavTable1, $name, $definition);
          $connection->addColumn($eavTable2, $name, $definition);
       }

       if (!$installer->tableExists('hatslogic_experiencesurvey')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('hatslogic_experiencesurvey')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'customer_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Customer Email'
                )
                ->addColumn(
					'comment',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'64k',
					[],
					'Comment'
                )
                ->addColumn(
                    'rating',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Rating'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Experience Survey');
            $installer->getConnection()->createTable($table);

        }
       $installer->endSetup();
   }
}

