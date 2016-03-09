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
				$isexists = $this->isCustomerExists($data['product_id'],$data['customer_id'],$currentDate);
				$data['isCustomerLoggedIn'] = 1;
			}else{
				$isexists = $this->isGuestExists($data['product_id'],$data['contact_number'],$data['email'],$currentDate);
			}
			if($isexists){
				$jsonData=json_encode(array('test', 'test', 'test'));
			}else{

				$productlog = $this->getProductLogFromRequest($data,$currentDate);

				$productlog->save();
				$jsonData=json_encode(array('test', 'test', 'test'));
			}
			//---save session product id wise
			$productViewedArray =  Mage::getSingleton('core/session' )->getData('productViewedArray');
			if ( !is_array($productViewedArray) ) $productViewedArray= array();
			if(!in_array($productViewedArray, $data['product_id']))		array_push($productViewedArray, $data['product_id']);

			Mage::log($productViewedArray ,Zend_log::INFO,'layout.log',true);

			Mage::getSingleton('core/session')->setData('productViewedArray', $productViewedArray);
				$this->getResponse()->setHeader('Content-type', 'application/json');
    		$this->getResponse()->setBody($jsonData);

			}
			catch (Exception $e){
					Mage::getSingleton('core/session')->addError($e->getMessage());
					Mage::getSingleton('core/session')->setTestData($data);
					$this->_redirect('*/*/register', array('_secure' => true));
					return false;
			}
	}
	public function getProductLogFromRequest($data,$currentDate){
			$productlog = Mage::getModel('viewer/viewer')->setData(array(
				'name' => $data['name'],
				'email' => $data['email'],
				'contact' => $data['contact_number'],
				'customer_id' => $data['customer_id'],
				'product_id' => $data['product_id'],
				'isCustomerLoggedIn' => $data['isCustomerLoggedIn'],
				'city' => Mage::app()->getWebsite()->getName(),
				'address' => $data['address'],
				'created_time' => $currentDate,
				'product_name'  => $data['product_name'],
				'product_sku'  => $data['product_sku'],
				'vendor_id' => $data['vendor_id'],
				'vendor_name' => $data['vendor_name'],
				'category_id' => $data['category_id'],
				'category_name' => $data['category_name']
			));
			return $productlog;
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
