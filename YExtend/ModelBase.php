<?php

class YExtend_ModelBase
{
    const TTL = 7200;

    private $memcache;

    public function __construct()
    {
        $config = Yaf_Dispatcher::getInstance()->getApplication()->getConfig();
        $this->memcache = new cache( array( $config->memcache->server . ':' . $config->memcache->port ) );
    }

    protected function getFromCache( $key )
    {
        return $this->memcache->get( $key );
    }

    protected function setInCache( $key, $value, $tag = null )
    {
        if ( !is_array( $tag ) )
        {
            $tag = array( $tag );
        }

        return $this->memcache->set( $key, $value, self::TTL, $tag );
    }

    protected function removeCacheTag( $tag )
    {
        return $this->memcache->invalidate( $tag );
    }
}