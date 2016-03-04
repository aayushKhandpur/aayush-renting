<?php

class Productlog_Viewer_Block_Adminhtml_Viewer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('viewer_grid');
        $this->setDefaultSort('increment_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
      $collection = Mage::getModel('viewer/viewer')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }

    protected function _prepareColumns()
      {
           $helper = Mage::helper('viewer');
          $this->addColumn('viewer_id', array(
            'header'    => Mage::helper('viewer')->__('ID'),
            'align'     =>'right',
            'width'     => '10px',
            'index'     => 'viewer_id',
          ));

          $this->addColumn('name', array(
            'header'    => Mage::helper('viewer')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
            'width'     => '50px',
          ));


          $this->addColumn('email', array(
              'header'    => Mage::helper('viewer')->__('Email'),
              'width'     => '150px',
              'index'     => 'email',
          ));
          $this->addColumn('contact', array(
              'header'    => Mage::helper('viewer')->__('Contact'),
              'width'     => '150px',
              'index'     => 'contact',
          ));
          $this->addColumn('customer_id', array(
              'header'    => Mage::helper('viewer')->__('Customer Id'),
              'width'     => '150px',
              'index'     => 'customer_id',
          ));
          $this->addColumn('product_id', array(
              'header'    => Mage::helper('viewer')->__('product Id'),
              'width'     => '150px',
              'index'     => 'product_id',
          ));
          $this->addColumn('address', array(
              'header'    => Mage::helper('viewer')->__('Address'),
              'width'     => '150px',
              'index'     => 'address',
          ));
          $this->addColumn('created_time', array(
              'header'    => Mage::helper('viewer')->__('Created Date'),
              'width'     => '150px',
              'index'     => 'created_time',
          ));

          $this->addExportType('*/*/exportViewerCsv', $helper->__('CSV'));
          $this->addExportType('*/*/exportViewerExcel', $helper->__('Excel XML'));

          return parent::_prepareColumns();
      }


}
