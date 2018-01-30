<?php
class Table extends Zend_Db_Table {
    public function __construct()
    {
        $url = constant ( "APPLICATION_PATH" ) . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'application.ini';
        $dbconfig = new Zend_Config_Ini ( $url, "mysql" );
        $db = Zend_Db::factory ( $dbconfig->db );
        $db->query ( 'SET NAMES UTF8' );
        $this->setDefaultAdapter ( $db );
        $this->_setup();
    }
    
    protected function _setup()
    {
        parent::_setup();
    }
}