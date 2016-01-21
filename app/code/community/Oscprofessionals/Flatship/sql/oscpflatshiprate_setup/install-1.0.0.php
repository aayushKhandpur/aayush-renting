<?php
/**
*
* @author      Oscprofessionals Team (support@oscprofessionals.com)
* @copyright   Copyright (c) 2014 Oscprofessionals (http://www.oscprofessionals.com)
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*
* @category    Oscprofessionals
* @package     Oscprofessionals_Flatship
*/

$installer = $this;

$installer->startSetup();

$installer->addAttribute("catalog_category", "shipping_cost", array (
    "group" => 'Category Shipping',
    "type" => "decimal",
    "backend" => "",
    "frontend" => "",
    "label" => "Shipping Cost",
    "input" => "text",
    "class" => "",
    "source" => "",
    "global" => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    "visible" => true,
    "required" => false,
    "user_defined" => false,
    "default" => "",
    "searchable" => false,
    "filterable" => false,
    "comparable" => false,
    "visible_on_front" => false,
    "unique" => false,
    )
);
$installer->addAttribute('catalog_product', 'shipping_cost', array(
        'group'             => 'General',
        'type'              => 'decimal',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Shipping Cost',
        'input'             => 'text',
        'class'             => '',
        'source'            => '',
        'is_global', Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => false,
        'default'           => '0',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
        'apply_to'          => 'simple,configurable,virtual,bundle,downloadable',
        'is_configurable'   => false,
        'used_in_product_listing', '1'
    ));

$installer->updateAttribute('catalog_product', 'shipping_cost', 'used_in_product_listing', '1');

$installer->endSetup(); 