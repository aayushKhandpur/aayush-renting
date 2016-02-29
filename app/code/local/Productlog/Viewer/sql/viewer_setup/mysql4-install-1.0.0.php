<?php

/**
 * @category    product
 * @package     product viewer log
**/

$installer = $this;
$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS '{$installer->getTable('productlog/viewer')}' (
  'entity_id' int(11) unsigned NOT NULL auto_increment,
  'name' varchar(255) NOT NULL DEFAULT '',
  'email' varchar(255) NOT NULL DEFAULT '',
  'contact' varchar(255) NOT NULL DEFAULT '',
  'customer_id' int(11) unsigned NOT NULL,
  'product_id' int(11) unsigned NOT NULL,
  'isCustomerLoggedIn' tinyint(1),
  'city' varchar(255) NOT NULL DEFAULT '',
  'address' text NOT NULL DEFAULT '',
  'timestampAt' timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  ('entity_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
