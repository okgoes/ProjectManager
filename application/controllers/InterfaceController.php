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
        echo json_encode($_POST);
        $this->setNoViewRender();
    }
}