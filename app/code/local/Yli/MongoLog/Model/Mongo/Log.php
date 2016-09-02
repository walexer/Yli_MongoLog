<?php
/**
 * Log Resource Model
 */
class Yli_MongoLog_Model_Mongo_Log extends Cm_Mongo_Model_Resource_Abstract
{
  
  public function _construct()
  {
    $this->_init('mongolog/log');
  }

}
