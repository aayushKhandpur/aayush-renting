<?php
/**
 *
 *
 * @category    Contactdetaillog
 * @package     Contactdetaillog_Productviewer
**/
class Productlog_Viewer_Model_Resource_Viewer extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
			$this->_init('viewer/viewer','viewer_id');
	}

}
