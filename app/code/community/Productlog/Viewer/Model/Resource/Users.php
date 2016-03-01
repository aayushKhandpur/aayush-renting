<?php
/**
 *
 *
 * @category    Contactdetaillog
 * @package     Contactdetaillog_Productviewer
**/
class Productlog_Viewer_Model_Resource_Users extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
			$this->_init('productlog_viewer/users','entity_id');
	}

}
