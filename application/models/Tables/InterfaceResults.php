<?php
class Tables_InterfaceResults extends Table {
    protected $_primary = 'id';
    protected $_name = 'pm_interface_results';
    
    public function getTable()
    {
        return $this->_name;
    }
}