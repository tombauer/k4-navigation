<!DOCTYPE html>
 
<html>
 
<head>
	<title>Demonstration of Twig Navigationhelper</title>
	<meta charset="UTF-8" />
	<meta name="description" content="Demonstration of Twig Navigationhelper" />
	<link href="style.css" type="text/css" rel="stylesheet" /> 

	<style>
	.active>a{
		color:red;
	}
	</style>

 </head>
 
<body>


<?php

include('simple_html_dom.php');

// -----------------------------------------------------------------------------

$str = <<<HTML

<ul>
    <li><a href="test1.html">item:1</a></li>
    <li><a href="test2.html">item:2</a></li>
    <li><a href="test3.html">item:3</a></li>
    <li><a href="test4.html">item:4</a></li>
        <li><a href="test5.html">item:5</a>
        <ul>
            <li><a href="test6.html">item:6</a></li>
            <li><a href="test7.html">item:7</a>
                <ul>
                    <li><a href="test8.html">item:8</a></li>
                    <li><a href="test9.html">item:9</a></li>
                </ul>
            </li>
        </ul>
    </li>
     <li><a href="test41.html">item:41</a></li>
        <li><a href="test51.html">item:51</a>
        <ul>
            <li><a href="test61.html">item:61</a></li>
            <li><a href="test71.html">item:71</a>
                <ul>
                    <li><a href="test81.html">item:81</a></li>
                    <li><a href="test91.html">item:91</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
HTML;


echo "<hr><h1>Normal ul li navigation with multiple levels</h1><p>The following navigation should be created dynamically by craft and then optimized for several usage with twig filters.</p><p>In this case i use the Parameter test8.html as selected item.</p>";
echo $str;

$html = str_get_html($str);


//set selected link 
$selectElem = $html->find('a[href="test8.html"]')[0];

//set class active to each Parent-Element
if (is_object($selectElem)){
    for ($i = 1; $i <= 20; $i++) {
        $selectElem->setAttribute("class","active");
        $selectElem =  $selectElem->parent();
        if (!is_object($selectElem)){
            break;
        }
    }    
}

echo "<hr><h1>Demo 1: Set class active to all parents</h1>" .$html;


?>

<?php
	//Output Breadcrumb of Link
    echo "<hr><h1>Demo 2: Breadcrumb</h1>";
    foreach($html->find('li[class="active"]') as $element){
          $elementLink = $element->find("a")[0];
            if ($elementLink->class == "active"){
                echo $elementLink->innertext;
            }else{
                echo $elementLink->outertext . ' > ';
            }
    }
?>

<?php
    $html2 =  str_get_html($html);

    echo "<hr><h1>Demo 3: Get only the first level of navigation</h1>";

    $filter = 'ul li ul';

    foreach($html2->find($filter) as $element){
          $element->outertext = "";
    }
   echo $html2;     
?>


<?php
    $html3 =  str_get_html($html);

    echo "<hr><h1>Demo 4: Get navigation for the second level</h1>";

    $filter = 'ul[class="active"] li[class="active"] ul';

    echo $html3->find($filter)[0]->outertext;
?>


<?php
    $html4 =  str_get_html($html);

    echo "<hr><h1>Demo 5: Get navigation for the third level</h1>";

    $filter = 'ul[class="active"] li[class="active"] ul ul';

    echo $html4->find($filter)[0]->outertext;
    

?>


<?php

    //Normal Navigation

    $html5 = str_get_html($html);

    echo "<hr><h1>Demo 6: Simple Navigation shows only first level and also selected sub levels</h1>";

    $filter = 'ul li[class!="active"] ul,ul li[!class] ul';
     foreach($html5->find($filter) as $element){
              $element->outertext = "";
        }
    echo $html5;
    
?>


 
</body>
</html>
