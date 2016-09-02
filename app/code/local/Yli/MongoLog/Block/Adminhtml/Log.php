<?php

class Yli_MongoLog_Block_Adminhtml_Log extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  
  public function __construct()
  {
    $this->_blockGroup = 'mongolog';
    $this->_controller = 'adminhtml_log';
    $this->_headerText = $this->__('Manage Log');
    parent::__construct();
  }
  
}