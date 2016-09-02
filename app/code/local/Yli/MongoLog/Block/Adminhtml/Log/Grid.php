<?php

class Yli_MongoLog_Block_Adminhtml_Log_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  
  public function __construct()
  {
    parent::__construct();
    $this->setId('mongoLog');
    //$this->setDefaultSort('_id');
  }
  
  public function _prepareCollection()
  {
    $this->setCollection(Mage::getResourceModel('mongolog/log_collection'));
    parent::_prepareCollection();
  }
  
  public function _prepareColumns()
  {
      $this->addColumn('_id', array(
          'header'         => $this->__('ID'),
          'index'          => '_id',
      ));
      
      $this->addColumn('message', array(
        'header'         => $this->__('Message'),
        'index'          => 'message',
      ));
      
      $this->addColumn('level', array(
          'header'         => $this->__('Level'),
          'index'          => 'level',
      ));
      
      $this->addColumn('file', array(
          'header'         => $this->__('File'),
          'index'          => 'file',
      ));

      $this->addColumn('created', array(
          'header'         => $this->__('Created'),
          'index'          => 'created',
      ));

    parent::_prepareColumns();
  }
  
  
}
