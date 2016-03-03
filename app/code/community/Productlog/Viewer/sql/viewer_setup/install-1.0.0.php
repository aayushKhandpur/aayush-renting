<?php

/**
 * @category    product
 * @package     product viewer log
**/

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('viewer'))
    ->addColumn('viewer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
      ), 'Name')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
      ), 'Email')
    ->addColumn('contact', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
      ), 'Contact')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => true,
        'unsigned'  => true,
      ), 'Customer Id')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'unsigned'  => true,
      ), 'Product Id')
    ->addColumn('isCustomerLoggedIn', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
        'nullable'  => false,
      ), 'Customer LoggedIn')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
        'default' => '',
      ), 'City')
    ->addColumn('address', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        'default' => '',
      ), 'Address')
    ->addColumn('created_time', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
       'nullable' => true,
       'default' => null,
       ), 'Created Date');
$installer->getConnection()->createTable($table);

$installer->endSetup();
