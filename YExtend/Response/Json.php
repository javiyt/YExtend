<?php

class YExtend_Response_Json extends Yaf_Plugin_Abstract
{
    public function routerShutdown( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response )
    {
        if ( $request->isXmlHttpRequest() )
        {
            Yaf_Dispatcher::getInstance()->setView( new YExtend_View_Ajax() );
        }
    }

    public function postDispatch( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response )
    {
        if ( $request->isXmlHttpRequest() )
        {
            header( 'Content-Type: application/json' );
        }
    }
}