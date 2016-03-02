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
				$currentDate =  Mage::getModel('core/date')->date('Y-m-d H:i:s');

			if($data['customer_id']){
					Mage::log(	'incheck 2' ,Zend_log::INFO,'layout.log',true);
					$isexists = $this._isCustomerExists($data['product_id'],$data['customer_id'],$currentDate);
						Mage::log('exists=='.$isexists ,Zend_log::INFO,'layout.log',true);
				if($isexists){
					return;
				}
				$data['isCustomerLoggedIn'] = 1;
			}else{
					Mage::log(	'incheck 3' ,Zend_log::INFO,'layout.log',true);
				if($this._isGuestExists($data['product_id'],$data['contact_number'],$email,$currentDate)){
					return;
				}
			}

			$productlog = Mage::getModel('productlog_viewer/users');

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

	public function _isGuestExists($productId,$contact,$email,$createdDate){
		$viewers = Mage::getModel('productlog_viewer/users')->getCollection();
		$viewers->addFieldToFilter('product_id',$productId)
						->addFieldToFilter('contact',$contact)
						->addFieldToFilter('email',$email)
						->addFieldToFilter('created_time',$createdDate);

			Mage::log(	$viewers ,Zend_log::INFO,'layout.log',true);
		if(count($viewers)>0){
				return true;
		}else{
				return false;
		}
	}

	public function _isCustomerExists($productId,$customerId,$createdDate){
			Mage::log(	'incheck4' ,Zend_log::INFO,'layout.log',true);
		$viewers = Mage::getModel('productlog_viewer/users')->getCollection();
		$viewers->addFieldToFilter('product_id',$productId)
						->addFieldToFilter('customer_id',$customerId)
						->addFieldToFilter('created_time',$createdDate);

		if(count($viewers)>0){
				return true;
		}else{
				return false;
		}
	}

	public function modelAction()
	{
		Mage::log(get_class() ,Zend_log::INFO,'layout.log',true);
		echo get_class(Mage::getModel('productlog_viewer/productlog'));
	}

}
