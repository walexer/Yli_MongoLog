<?php
/**
 * Log Collection
 */
class Yli_MongoLog_Model_Mongo_Log_Collection extends Cm_Mongo_Model_Resource_Collection_Abstract
{
  
  public function _construct()
  {
    $this->_init('mongolog/log');
  }
  
}
