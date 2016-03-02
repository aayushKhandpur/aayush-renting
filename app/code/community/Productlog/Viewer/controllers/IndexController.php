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

		// Mage::log(	'',Zend_log::INFO,'layout.log',true);
				echo 'kuldeep here';
	}

	public function saveAction()
	{
		$data = $this->getRequest()->getPost();
		try
		{
			if($data['customer_id']){
				$data['isCustomerLoggedIn'] = 1;
			}

			$productlog = Mage::getModel('productlog_viewer/users');
			$currentDate =  Mage::getModel('core/date')->date('Y-m-d H:i:s');
				Mage::log(	$currentDate ,Zend_log::INFO,'layout.log',true);
			$productlog = Mage::getModel('productlog_viewer/users')->setData(array(
					'name' => $data['name'],
					'email' => $data['email'],
					'contact' => $data['contact_number'],
					'created_time' => $currentDate,
					'isCustomerLoggedIn' => $data['isCustomerLoggedIn'],
					'customer_id' => $data['customer_id'],
					'product_id' => $data['product_id'],
					'address' => $data['address']
				))->save();

			 Mage::log(	'in dex :: ' ,Zend_log::INFO,'layout.log',true);
			 return "true";
		//		$this->_redirect('*/*/index');
			}
			catch (Exception $e){
					Mage::getSingleton('core/session')->addError($e->getMessage());
					Mage::getSingleton('core/session')->setTestData($data);
					$this->_redirect('*/*/register', array('_secure' => true));
					return false;
			}
	}

	public function modelAction()
	{
		Mage::log(get_class() ,Zend_log::INFO,'layout.log',true);
		echo get_class(Mage::getModel('productlog_viewer/productlog'));
	}

}
