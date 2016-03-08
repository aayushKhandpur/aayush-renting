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
          $this->addColumn('address', array(
              'header'    => Mage::helper('viewer')->__('Address'),
              'width'     => '150px',
              'index'     => 'address',
          ));
          $this->addColumn('product_name', array(
              'header'    => Mage::helper('viewer')->__('Product Name'),
              'width'     => '150px',
              'index'     => 'product_name',
          ));
          $this->addColumn('product_sku', array(
              'header'    => Mage::helper('viewer')->__('Product Sku'),
              'width'     => '150px',
              'index'     => 'product_sku',
          ));
          $this->addColumn('category_name', array(
              'header'    => Mage::helper('viewer')->__('Category Name'),
              'width'     => '150px',
              'index'     => 'category_name',
          ));
          $this->addColumn('vendor_name', array(
              'header'    => Mage::helper('viewer')->__('Renter Name'),
              'width'     => '150px',
              'index'     => 'vendor_name',
          ));
          $this->addColumn('city', array(
              'header'    => Mage::helper('viewer')->__('City'),
              'width'     => '150px',
              'index'     => 'city',
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
