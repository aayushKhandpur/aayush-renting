<?php
class Productlog_Viewer_Adminhtml_ViewerController extends Mage_Adminhtml_Controller_Action {

  public function indexAction()
     {
       Mage::log(	'incheck 2' ,Zend_log::INFO,'layout.log',true);
         $this->_title($this->__('Viewer'))->_title($this->__('viewer'));
         $this->loadLayout();
         $this->_setActiveMenu('viewer/viewer');
         $this->_addContent($this->getLayout()->createBlock('viewer/adminhtml_viewer_viewer'));
         Mage::log(	'incheck 32' ,Zend_log::INFO,'layout.log',true);
         $this->renderLayout();
     }

     public function gridAction()
     {
        Mage::log(	'incheck 21' ,Zend_log::INFO,'layout.log',true);
         $this->loadLayout();
         $this->getResponse()->setBody(
             $this->getLayout()->createBlock('viewer/adminhtml_viewer_viewer_grid')->toHtml()
         );
     }

     public function exportInchooCsvAction()
     {
        Mage::log(	'incheck 22' ,Zend_log::INFO,'layout.log',true);
         $fileName = 'orders_inchoo.csv';
         $grid = $this->getLayout()->createBlock('viewer/adminhtml_viewer_viewer_grid');
         $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
     }

     public function exportInchooExcelAction()
     {
        Mage::log(	'incheck 23' ,Zend_log::INFO,'layout.log',true);
         $fileName = 'orders_inchoo.xml';
         $grid = $this->getLayout()->createBlock('viewer/adminhtml_viewer_viewer_grid');
         $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
     }

}
?>
