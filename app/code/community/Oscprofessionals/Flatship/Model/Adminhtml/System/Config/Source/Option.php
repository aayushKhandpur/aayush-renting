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
class Oscprofessionals_Flatship_Model_Adminhtml_System_Config_Source_Option
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'product', 'label'=>Mage::helper('adminhtml')->__('Product')),
            array('value' => 'category', 'label'=>Mage::helper('adminhtml')->__('Category')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => Mage::helper('adminhtml')->__('Product'),
            1 => Mage::helper('adminhtml')->__('Category'),
        );
    }

}
