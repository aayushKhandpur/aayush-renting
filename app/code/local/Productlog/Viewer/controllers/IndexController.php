<?php
/**
 *
 *
 * @category    Contactdetaillog
 * @package     Contactdetaillog_Productviewer
**/
class Productlog_Viewer_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{

		 Mage::log(	'in dex :: ' ,Zend_log::INFO,'layout.log',true);
		 Mage::log(	$this->getRequest()->getParam('name'),Zend_log::INFO,'layout.log',true);
				echo 'kuldeep here';
	}

	public function modelAction()
	{
		Mage::log(get_class(Mage::getModel('productlog_viewer/productlog')) ,Zend_log::INFO,'layout.log',true);
		echo get_class(Mage::getModel('productlog_viewer/productlog'));
	}

}
