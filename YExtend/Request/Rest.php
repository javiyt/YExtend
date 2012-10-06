<?php

class YExtend_Request_Rest extends Yaf_Plugin_Abstract
{
    public function routerShutdown( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response )
    {
        if ( $request->isXmlHttpRequest() )
        {
            $request->setActionName( strtolower( $_SERVER['REQUEST_METHOD'] ) );
            $params = json_decode( file_get_contents( 'php://input' ), true );
            if ( !empty( $params ) && is_array( $params ) )
            {
                foreach ( $params as $key => $value )
                {
                    $request->setParam( $key, $value );
                }
            }
        }
    }
}