<?php

/**
 * @category    product
 * @package     product viewer log
**/

$installer = $this;
$installer->startSetup();
$connection  = $installer->getConnection();
    $connection->addColumn($installer->getTable('viewer'), 'product_name',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => '',
        'comment' => 'Product Name'
    ));
    $connection->addColumn($installer->getTable('viewer'), 'product_sku',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'comment' => 'Product Sku'
    ));
    $connection->addColumn($installer->getTable('viewer'), 'vendor_id',
       array(
           'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
           'nullable' => true,
           'comment' => 'Vendor Id'
       ));
  $connection->addColumn($installer->getTable('viewer'), 'vendor_name',
   array(
       'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
       'nullable' => true,
       'default' => '',
       'comment' => 'Vendor Name'
   ));
      $connection->addColumn($installer->getTable('viewer'), 'category_id',
      array(
          'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
          'nullable' => true,
          'comment' => 'Category Id'
      ));
      $connection->addColumn($installer->getTable('viewer'),'category_name',
      array(
          'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
          'nullable' => true,
          'default' => '',
          'comment' => 'Category Name'
      ));

$installer->endSetup();
