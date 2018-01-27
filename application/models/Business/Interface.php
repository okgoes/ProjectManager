<?php

class Business_Interface {
    private $_interface = null;
    private $_interfaceParams = null;
    private $_interfaceResults = null;
    
    public function __construct() 
    {
        $this->_interface = new Table_Interface();
        $this->_interfaceParams = new Table_InterfaceParams();
        $this->_interfaceResults = new Table_InterfaceResults();
    }
    
    /**
     * 创建一个完整的接口
     */
    public function create($data) 
    {
        try {
            $db = $this->_interface->getDefaultAdapter()->beginTransaction();
            $interfaceId = $this->_interface->insert(array(
                "project_id" => 1,
                "name" => $data['name'],
                "url" => $data['url'],
                "request_method" => $data['request_method'],
                "description" => $data['description'],
                "sort" => 0,
                "createtime" => time(),
                'updatetime' => time()
            ));
            var_dump($interfaceId);
            $this->_interfaceParams->insert(array(
                'interface_id' => $interfaceId,
                'field_name' => $data['fieldName'],
                'field_type' => $data['fieldType'],
                'fieid_length' => null,
                'required' => $data['required'],
                'comment' => $data['comment'],
                'parent_id' => $data['parent_id'],
                "createtime" => time(),
                'updatetime' => time()
            ));
            $this->_interfaceResults->insert(array(
                "interface_id" => $interfaceId,
                "field_name" => $data['rFieldName'],
                'field_type' => $data['rFieldType'],
                'required' => $data['rRequired'],
                'comment' => $data['rComment'],
                'parent_id' => $data['rParent_id'],
                "createtime" => time(),
                'updatetime' => time()
            ));
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
        }
        
    }

}