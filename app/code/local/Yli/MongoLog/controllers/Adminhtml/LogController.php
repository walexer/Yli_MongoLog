<?php

class Yli_MongoLog_Adminhtml_LogController extends Mage_Adminhtml_Controller_Action {
  
  public function indexAction()
  {
    $this->loadLayout()
      ->_setActiveMenu('system/log')
      ->_title($this->__('Log'))
      ->_addContent($this->getLayout()->createBlock('mongolog/adminhtml_log'))
      ->renderLayout();
  }

}