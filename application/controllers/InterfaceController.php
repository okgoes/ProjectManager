<?php

class InterfaceController extends BaseController
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $interfaceBuz = new Business_Interface();
        $projectBuz = new Business_Project();
        $interface = $interfaceBuz->getLists();
        $project = $projectBuz->getLists();
        $this->view->interface = $interface;
        $this->view->project = $project;
    }

    public function createAction()
    {
        $interfaceBuz = new Business_Interface();
        $res = $interfaceBuz->create($_POST);
        echo $res;
        $this->setNoViewRender();
    }

    public function createparamsAction() 
    {
        $interfaceBuz = new Business_Interface();
        $res = $interfaceBuz->createParam($_POST);
        echo $res;
        $this->setNoViewRender();
    }
    
    public function listsAction() 
    {
        $interfaceBuz = new Business_Interface();
        $res = $interfaceBuz->getLists();
        echo $res;
        $this->setNoViewRender();
    }
    
    public function detailAction() 
    {
        $interfaceBuz = new Business_Interface();
        echo $interfaceBuz->detail($this->_request->getParam('interfaceId', 0));
        $this->setNoViewRender();
    }
}