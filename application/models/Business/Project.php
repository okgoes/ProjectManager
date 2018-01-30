<?php
class Business_Project {
    private $_project = null;
    
    public function __construct()
    {
        $this->_project = new Tables_Project();
    }
    
    public function getLists() 
    {
        return $this->_project->select()->where("state = ?", 1)->query()->fetchAll();
    }
}
