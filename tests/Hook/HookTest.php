<?php

namespace App\Tests\Hook;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use App\Hook\Hook;

class HookTest extends TestCase
{
    protected $hook;
    public function setUp(){
        $this->hook = new Hook();
    }
    public function testGetCodePostale()
    {   $q=array();
        $cp= $this->hook->getCodePostale($q);
        $this->assertTrue($cp =="");
        $q=array('Villepinte', '93');
        $cp= $this->hook->getCodePostale($q);
        $this->assertTrue($cp =="93420");
    }
    public function testCheckFileExist()
    {   
        $response=$this->hook->checkFileExist('data/job.xml');
        $this->assertTrue($response);
        $response=$this->hook->checkFileExist('data/job.json');
        $this->assertFalse($response);
    }
}
