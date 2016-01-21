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
class Oscprofessionals_Flatship_Model_Adminhtml_System_Config_Source_Country
{

    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('customer/group_collection')
                //->setRealGroupsFilter()
                ->loadData()->toOptionArray();
            array_unshift($this->_options, array('value'=> '', 'label'=> '-- Please Select --'));
        }
        return $this->_options;
    }
}


