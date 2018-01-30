<?php
class Tables_Interface extends Table {
    protected $_primary = 'id';
    protected $_name = 'pm_interface';
    
    public function getTable()
    {
        return $this->_name;
    }
}