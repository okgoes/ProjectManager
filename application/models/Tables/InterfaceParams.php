<?php
class Tables_InterfaceParams extends Table {
    protected $_primary = 'id';
    protected $_name = 'pm_interface_params';
    
    public function getTable()
    {
        return $this->_name;
    }
}