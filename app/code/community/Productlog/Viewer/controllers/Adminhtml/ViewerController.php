<?php
class Productlog_Viewer_Adminhtml_ViewerController extends Mage_Adminhtml_Controller_Action {

  public function indexAction() {
       $this->loadLayout();
               $this->renderLayout();
   }

   public function gridAction()
     {      
         $this->loadLayout();
         $this->getResponse()->setBody(
             $this->getLayout()->createBlock('viewer/adminhtml_viewer_grid')->toHtml()
         );
     }

     public function exportViewerCsvAction()
     {
         $fileName = 'viewer.csv';
         $grid = $this->getLayout()->createBlock('viewer/adminhtml_viewer_grid');
         $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
     }

     public function exportViewerExcelAction()
     {
         $fileName = 'viewer.xml';
         $grid = $this->getLayout()->createBlock('viewer/adminhtml_viewer_grid');
         $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
     }

}
?>
