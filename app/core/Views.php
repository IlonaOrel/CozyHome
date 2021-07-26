<?php


namespace core;


class Views
{
    public  function render($pageView, $templateViews){
        include_once 'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.$templateViews;
    }

}