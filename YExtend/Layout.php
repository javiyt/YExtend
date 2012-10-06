<?php

class YExtend_Layout extends Yaf_Plugin_Abstract
{
    static private $instance;
    private $_layoutDir;
    private $_layoutFile;
    private $_layoutVars = array();
    private $_title = array();
    private $_js = array();
    private $_metas = array();
    private $_canonical;
    private $_layoutEnabled = true;

    private function __construct()
    {
        $config = Yaf_Application::app()->getConfig();

        $this->_layoutFile = ( !empty( $config->application->layoutFile ) ) ? $config->application->layoutFile : 'layout.phtml';
        $this->_layoutDir  = ( !empty( $config->application->layoutDir ) ) ? $config->application->layoutDir : APP_PATH . 'layout';
    }

    static public function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __set( $name, $value )
    {
        $this->_layoutVars[ $name ] = $value;
    }

    public function disableLayout()
    {
        $this->_layoutEnabled = false;
    }

    public function addTitle( $title )
    {
        $this->_title[] = $title;
    }

    public function getTitle()
    {
        return implode( ' :: ', array_reverse( $this->_title ) );
    }

    public function addScript( $script )
    {
        if ( !in_array( $script, $this->_js ) )
        {
            $this->_js[] = $script;
        }
    }

    public function getScript()
    {
        $scripts = '';
        foreach ( $this->_js as $script)
        {
            $scripts .= '<script type="text/javascript" src="' . $script . '"></script>';
        }

        return $scripts;
    }

    public function addMeta( $key, $value, $og = false )
    {
        if ( false !== $og )
        {
            $key = 'og:' . $key;
        }
        $this->_metas[$key] = $value;
    }

    public function getMeta()
    {
        $metas = '';
        foreach ( $this->_metas as $key => $value )
        {
            $content = 'name';
            if ( 'og:' == substr( $key, 0, 3 ) )
            {
                $content = 'property';
            }
            $metas .= '<meta ' . $content . '="' . $key . '" value="' . $value . '">';
        }

        return $metas;
    }

    public function setCanonical( $url )
    {
        $this->_canonical = $url;
    }

    public function getCanonical()
    {
        return ( !empty( $this->_canonical ) ) ? '<link rel="canonical" href="' . $this->_canonical . '">' : '';
    }

    protected function getBodyId( Yaf_Request_Abstract $request )
    {
        return strtolower( $request->getControllerName() . '_' . $request->getActionName() );
    }

    public function getAnalytics()
    {
        $config = Yaf_Application::app()->getConfig();
        return $config->analytics->account;
    }

    public function postDispatch( Yaf_Request_Abstract $request, Yaf_Response_Abstract $response )
    {
        if ( $this->_layoutEnabled )
        {
            /* get the body of the response */
            $body = $response->getBody();

            /*clear existing response*/
            $response->clearBody();

            /* wrap it in the layout */
            $layout          = new Yaf_View_Simple( $this->_layoutDir );
            $layout->content = $body;
            $layout->assign( 'layout', $this->_layoutVars );
            $layout->body_id = $this->getBodyId( $request );

            /* set the response to use the wrapped version of the content */
            $response->setBody( $layout->render( $this->_layoutFile ) );
        }
    }

}