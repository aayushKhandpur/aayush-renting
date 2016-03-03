<?php
class Medma_MarketPlace_Adminhtml_ViewerController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
      	Mage::log(	'in it' ,Zend_log::INFO,'layout.log',true);
       $this->loadLayout()
        ->_setActiveMenu('viewer/items')
        ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

       return $this;
      }

    public function indexAction() {
      	Mage::log(	'in it  2' ,Zend_log::INFO,'layout.log',true);
       $this->_initAction()->renderLayout();
      }

}
?>
