<?php

namespace App\Tests\Hook;
use App\Hook\RealEstateHook;


use PHPUnit\Framework\TestCase;

class RealEstateHookTest extends TestCase
{
    protected $realEstateHook;

    public function setUp(){
        $this->realEstateHook = new RealEstateHook();
    }

    public function testGetCategory()
    {   
        $categories = array(
            array('Vente','Maison'),
            array('location','Maison'),
            array('Bureaux et commerces','Maison'),
            // array('coloc','Maison'),
            // array('','')
        );
        foreach($categories as $cat){
            $c=$this->realEstateHook->getCategory($cat[0], $cat[1]);
            $this->assertTrue(in_array($c['categorie'], [1,2,3,4]));
            if($c['categorie'] === 4){
                $this->assertTrue(!empty($c['type']));
            }else{
                $this->assertTrue(empty($c['type']));
            }
        }
    
    }
}
