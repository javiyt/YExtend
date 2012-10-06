<?php

class YExtend_Controller_Cli extends Yaf_Controller_Abstract
{
    public function init()
    {
        Yaf_Dispatcher::getInstance()->disableView();
        YExtend_Layout::getInstance()->disableLayout();
    }
}