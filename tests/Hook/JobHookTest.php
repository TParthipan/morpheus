<?php

namespace App\Tests\Hook;
use App\Hook\JobHook;


use PHPUnit\Framework\TestCase;

class JobHookTest extends TestCase
{
    protected $jobHook;
    public function setUp(){
        $this->jobHook = new JobHook();
    }
    public function testGetContratTrue()
    {
        $contrats = array('cdi','cdd','interim','stage/alternance');
        foreach($contrats as $contrat){
            $c=$this->jobHook->getContrat($contrat);
            $this->assertTrue(in_array($c, [1,2,3,4]));
        }
    }
    public function testGetContratFalse()
    {
        $contrats = array('','freelance');
        foreach($contrats as $contrat){
            $c=$this->jobHook->getContrat($contrat);
            $this->assertTrue($c === 0);
        }
    }
}
