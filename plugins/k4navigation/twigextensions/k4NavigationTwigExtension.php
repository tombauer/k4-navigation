<?php 
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class k4NavigationTwigExtension extends \Twig_Extension
{


    public function getName()
    {
        return 'k4 Navigation Helper';
    }

    public function getFilters()
    {
        $returnArray = array();
        $methods = array(
            'k4NavigationGetActivePath',
            'k4NavigationGetBreadcrumb',
            'k4NavigationGetSimpleNavigation',
        );

        foreach ($methods as $methodName) {
            $returnArray[$methodName] = new \Twig_Filter_Method($this, $methodName);
        }

        return $returnArray;
    }    
    

    public function k4NavigationGetActivePath($content,$selectedPath)
    {

        $html = str_get_html($content);
       
        $selectedFilter = 'a[href="'.$selectedPath.'"]';

        //set selected link 
        $selectElemArr = $html->find($selectedFilter);

        
        if (is_array($selectElemArr)){
            $selectElem = $selectElemArr[0];

           // Element wurde gefunden - Active Klassen setzen
            for ($i = 1; $i <= 20; $i++) {
                $selectElem->setAttribute("class","active");
                $selectElem =  $selectElem->parent();
                if (!is_object($selectElem)){
                    break;
                }
            }    
        } else
        {
            $html = $content . "<!-- k4-navigation no link active -->";
        }
    
        return $html;
               
    }
    
    public function k4NavigationGetBreadcrumb($content,$selectedPath,$dividerText = " > ")
    {
       
     
        $html = str_get_html($this->k4NavigationGetActivePath($content,$selectedPath));
        
        $breadcrumb = "";
           foreach($html->find('li[class="active"]') as $element){
              $elementLink = $element->find("a")[0];
                if ($elementLink->class == "active"){
                    $breadcrumb = $breadcrumb. $elementLink->innertext;
                }else{
                    $breadcrumb = $breadcrumb . $elementLink->outertext . $dividerText;
                }
        }
        $breadcrumb = $breadcrumb;
        return $breadcrumb;         
    }
    
    public function k4NavigationGetSimpleNavigation($content,$selectedPath)
    {
     
        $html = str_get_html($this->k4NavigationGetActivePath($content,$selectedPath));
        
        $filter = 'ul li[class!="active"] ul,ul li[!class] ul';
        foreach($html->find($filter) as $element){
                  $element->outertext = "";
        }
        return $html;        
    } 
    
}