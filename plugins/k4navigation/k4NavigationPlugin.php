<?php
namespace Craft;


class k4NavigationPlugin extends BasePlugin
{
    public funtion init(){
        require_once "./library/simple_html_dom.php";
    }
    
    public function getName()
    {
         return Craft::t('k4 Navigation');
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Thomas Bauer';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.bahu.ch';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.k4navigation.twigextensions.k4NavigationTwigExtension');

        return new k4NavigationTwigExtension();
    }
}
