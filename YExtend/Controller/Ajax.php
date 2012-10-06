<?php

class YExtend_Controller_Ajax extends YExtend_Controller_Abstract
{
    public function init()
    {
        YExtend_Layout::getInstance()->disableLayout();
    }
}