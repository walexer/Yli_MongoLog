<?php 

class Yli_MongoLog_Model_Logwriter extends Zend_Log_Writer_Stream
{
    
    const SYSTEM_CONFIG_ENABLED 		= 'dev/mongolog/enabled';
    
    protected $_file;
    protected $mongoCollection;
    
    public function __construct($logFile)
    {
        if(Mage::getStoreConfig(self::SYSTEM_CONFIG_ENABLED)){
            $logFile = explode(DS, $logFile);
            $this->_file = end($logFile);
            
            $server = Mage::getStoreConfig('dev/mongolog/server');
            $port = Mage::getStoreConfig('dev/mongolog/port');
            $db = Mage::getStoreConfig('dev/mongolog/db');
            $collection = Mage::getStoreConfig('dev/mongolog/collection');
            $split_file = Mage::getStoreConfig('dev/mongolog/split_file');
            if($split_file){
                $collection = $this->_file;
            }
            $username = Mage::getStoreConfig('dev/mongolog/username');
            $password = Mage::getStoreConfig('dev/mongolog/password');
            try {
                if ($username && $password){
                    $mongo = new MongoClient("mongodb://$server:$port",array("username" => $username, "password" => $password));
                }else{
                    $mongo = new MongoClient("mongodb://$server:$port");
                }
            } catch (Exception $e) {
                return;
            }
            
            $this->mongoCollection = $mongo->selectDB($db)->selectCollection($collection);
        }else{
            parent::__construct($logFile);
        }
        
    }
    
    protected function _write($event)
    {
        if(Mage::getStoreConfig(self::SYSTEM_CONFIG_ENABLED)){
            if (null === $this->mongoCollection) {
                throw new Zend_Log_Exception('MongoCollection must be defined');
            }
            
            if (isset($event['timestamp']) && $event['timestamp'] instanceof DateTime) {
                $event['timestamp'] = new MongoDate($event['timestamp']->getTimestamp());
            }
            
            $document = array(
                "message" => $event['message'],
                "level" => $event['priorityName'],
                "file" => $this->_file,
                "created"=> $event['timestamp']
            ); 
            $this->mongoCollection->insert($document);
        }else{
            return parent::_write($event);
        }
    }
    
    
    
    static public function factory($config)
    {
        return new self();
    }

}