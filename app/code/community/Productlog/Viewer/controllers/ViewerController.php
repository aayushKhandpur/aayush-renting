<?php
/**
 *
 *
 * @category    Contactdetaillog
 * @package     Contactdetaillog_Productviewer
**/
class Productlog_Viewer_ViewerController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
	$this->loadLayout();
	$this->renderLayout();
	}

	public function saveAction()
	{
		$data = $this->getRequest()->getPost();
		try
		{
				$currentDate =  Mage::getModel('core/date')->date('Y-m-d');

			if($data['customer_id']){
					Mage::log(	'incheck 2' ,Zend_log::INFO,'layout.log',true);
					$isexists = $this->isCustomerExists($data['product_id'],$data['customer_id'],$currentDate);
						Mage::log('exists=='.$isexists ,Zend_log::INFO,'layout.log',true);
				if($isexists){
					return;
				}
				$data['isCustomerLoggedIn'] = 1;
			}else{
					Mage::log(	'incheck 3' ,Zend_log::INFO,'layout.log',true);
				if($this->isGuestExists($data['product_id'],$data['contact_number'],$data['email'],$currentDate)){
					return;
				}
			}

			$productlog = Mage::getModel('viewer/viewer')->setData(array(
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

	public function isGuestExists($productId,$contact,$email,$createdDate){

		$viewers = Mage::getModel('viewer/viewer')->getCollection()
						->addFieldToFilter('product_id',$productId)
						->addFieldToFilter('contact',$contact)
						->addFieldToFilter('email',$email)
						->addFieldToFilter('created_time',$createdDate);
		if($viewers->count()>0){
				return true;
		}else{
				return false;
		}
	}

	public function isCustomerExists($productId,$customerId,$createdDate){

		$viewers = Mage::getModel('viewer/viewer')->getCollection()
							->addFieldToFilter('product_id',$productId)
							->addFieldToFilter('customer_id',$customerId)
							->addFieldToFilter('created_time',$createdDate);
		if($viewers->count()>0){
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