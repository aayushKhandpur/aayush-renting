<?php

class Productlog_Viewer_Block_Adminhtml_Viewer_Viewer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'Viewer';
        $this->_controller = 'adminhtml_viewer';
        $this->_headerText = Mage::helper('viewer')->__('Viewer');
 Mage::log(	'in check 321' ,Zend_log::INFO,'layout.log',true);
        parent::__construct();
        $this->_removeButton('add');
    }
}
