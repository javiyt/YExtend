<?php

abstract class YExtend_Controller_Abstract extends Yaf_Controller_Abstract
{
}

class Exception_404 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 404 Not Found' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}

class Exception_403 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 403 Forbidden' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}

class Exception_500 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 500 Internal Server Error' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}

class Exception_415 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 415 Unsupported Media Type' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}

class Exception_409 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 409 Conflict' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}

class Exception_417 extends Exception
{
    public function __construct( YExtend_Controller_Abstract $e )
    {
        if ( $e instanceof YExtend_Controller_Ajax )
        {
            header( 'HTTP/1.0 417 Expectation Failed' );
        }
        else
        {
            $e->getResponse()->setRedirect( '/not-found' );
            Yaf_Dispatcher::getInstance()->disableView();
        }
    }
}