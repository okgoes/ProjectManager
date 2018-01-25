<?php

class BaseController extends Zend_Controller_Action {
	public function setNoViewRender($flag = true) 
	{
		Zend_Controller_Front::getInstance()->setParam('noViewRenderer', $flag);
	}
}