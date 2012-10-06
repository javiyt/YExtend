<?php

abstract class YExtend_Controller_Abstract extends Yaf_Controller_Abstract
{
}

class Exception_404 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        $e->getResponse()->setRedirect( '/not-found' );
        Yaf_Dispatcher::getInstance()->disableView();
    }
}