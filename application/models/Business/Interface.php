<?php

class Business_Interface {
    private $_interface = null;
    private $_interfaceParams = null;
    private $_interfaceResults = null;

    public function __construct() 
    {
        $this->_interface = new Tables_Interface();
        $this->_interfaceParams = new Tables_InterfaceParams();
        $this->_interfaceResults = new Tables_InterfaceResults();
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
                "state" => 1,
                "createtime" => time(),
                'updatetime' => time()
            ));
            // var_dump($interfaceId);
            // $this->_interfaceParams->insert(array(
            //     'interface_id' => $interfaceId,
            //     'field_name' => $data['fieldName'],
            //     'field_type' => $data['fieldType'],
            //     'fieid_length' => null,
            //     'required' => $data['required'],
            //     'comment' => $data['comment'],
            //     'parent_id' => $data['parent_id'],
            //     "createtime" => time(),
            //     'updatetime' => time()
            // ));
            // $this->_interfaceResults->insert(array(
            //     "interface_id" => $interfaceId,
            //     "field_name" => $data['rFieldName'],
            //     'field_type' => $data['rFieldType'],
            //     'required' => $data['rRequired'],
            //     'comment' => $data['rComment'],
            //     'parent_id' => $data['rParent_id'],
            //     "createtime" => time(),
            //     'updatetime' => time()
            // ));
            $db->commit();
            return Result::result(Result::SUCCESS_CODE, $interfaceId, Result::SUCCESS);
        } catch (Exception $e) {
            var_dump($e);
            $db->rollBack();
        }
        return 0;
    }

    public function createParam($data) 
    {
        $id = $this->_interfaceParams->insert(array(
            'interface_id' => $data['interfaceId'],
            'field_name' => $data['fieldName'],
            'field_type' => $data['fieldType'],
            'fieid_length' => null,
            'required' => $data['required'],
            'comment' => $data['comment'],
            'parent_id' => $data['parent_id'],
            'state' => 1,
            "createtime" => time(),
            'updatetime' => time()
        ));
        return Result::result(Result::SUCCESS_CODE, $id, Result::SUCCESS);
    }

    public function getLists() 
    {
        $data = $this->_interface->select()->where('state = ?', 1)->query()->fetchAll();
//         return Result::result(Result::SUCCESS_CODE, $data, Result::SUCCESS);
        return $data;
    }
    
    public function detail($interfaceId) 
    {
        $params = $this->_interfaceParams->select()->where('interface_id = ?', $interfaceId)->query()->fetchAll();
        $results = $this->_interfaceResults->select()->where('interface_id = ?', $interfaceId)->query()->fetchAll();
        return Result::result(Result::SUCCESS_CODE, array($params, $results), Result::SUCCESS);
    }
}