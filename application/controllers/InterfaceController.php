<?php

class InterfaceController extends BaseController
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    }

    public function createAction()
    {
        // echo json_encode($_POST);
        // $this->setNoViewRender();
        $interfaceBuz = new Business_Interface();
        $res = $interfaceBuz->create($_POST);
        echo json_encode($res);
        $this->setNoViewRender();
    }

    public function createparamsAction() 
    {
        $interfaceBuz = new Business_Interface();
        $res = $interfaceBuz->createParam($_POST);
        echo json_encode($res);
        $this->setNoViewRender();
    }
}