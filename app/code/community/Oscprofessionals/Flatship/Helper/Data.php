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

class Oscprofessionals_Flatship_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_ENABLE = 'carriers/oscpflatshiprate/active';
    CONST XML_PATH_MODE = 'carriers/oscpflatshiprate/shipping_mode';
    const XML_PATH_CUSTOMER_GROUP_ENABLE = 'carriers/oscpflatshiprate/customer_group';
    const XML_PATH_CUSTOMER_GROUP_ID = 'carriers/oscpflatshiprate/customer_group_id';

    /**
     * Check module is enable or not 
     * @param (null) storeId
     * @return boolean
     */
    public function isEnable($storeId = null)
    {   
      if (is_null($storeId)) 
         {
            $storeId = Mage::app()->getStore()->getId();
         }
        return Mage::getStoreConfig(self::XML_PATH_ENABLE, $storeId);
    }

    /**
     * Check shipping method mode type either Category or Product
     * @param (null) storeId
     * @return $modeType (string)
     */
    Public function getMode($storeId = null)
    {   
      if (is_null($storeId)) 
         {
            $storeId = Mage::app()->getStore()->getId();
         }
        return Mage::getStoreConfig(self::XML_PATH_MODE, $storeId);
    }

    /**
     * Check customer group is enable or not 
     * @param (null) storeId
     * @return boolean
     */
    public function isAllowedCustomerGroup($storeId = null)
    {
      if (is_null($storeId)) 
         {
            $storeId = Mage::app()->getStore()->getId();
         }
        return Mage::getStoreConfig(self::XML_PATH_CUSTOMER_GROUP_ENABLE, $storeId);
    }


    /**
     * get customer group Id
     * @param (null) storeId
     * @return boolean
     */
    public function getCustomerGroupId($storeId = null)
    {
      if (is_null($storeId)) 
         {
            $storeId = Mage::app()->getStore()->getId();
         }
        return Mage::getStoreConfig(self::XML_PATH_CUSTOMER_GROUP_ID, $storeId);
    }

}