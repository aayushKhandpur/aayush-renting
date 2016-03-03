<?php
/**
 *
 *
 * @category    Contactdetaillog
 * @package     Contactdetaillog_Productviewer
**/
class Productlog_Viewer_Model_Resource_Viewer_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
			$this->_init('viewer/viewer');
	}

}
