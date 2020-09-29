<?php

namespace App\Converter;

use DOMElement;

class XMLConverter
{
    public static function xmlToArray(string $filepath): array
    {   $jobArray=array();
        $domDocument = new \DOMDocument();
        $domDocument->loadXml(\file_get_contents($filepath));
        $jobs = $domDocument->getElementsByTagName('job');
        foreach ($jobs as $job) {
            $oneJob=array();          
            foreach($job->getElementsByTagName('*') as $element ){
                if($element->nodeName ==  'description_poste'){
                    $oneJob[$element->tagName] = strip_tags($element->ownerDocument->saveXML($element));
                }else{
                    $oneJob[$element->tagName] =$data=$element->nodeValue;
                }
            }
            array_push($jobArray,$oneJob);
        }
        return $jobArray;
    }
}

