<?php
class Tables_Project extends Table {
    protected $_primary = 'id';
    protected $_name = 'pm_project';
    
    public function getTable() 
    {
        return $this->_name;
    }
}