<?php

namespace Troopers\AlertifyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlertifyControllerTest extends WebTestCase
{
    public function testConfirm()
    {
        $_SERVER['KERNEL_CLASS'] = TestKernel::class;

        $client = static::createClient();

        $client->request('GET', '/alertify/confirm');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAjax()
    {
        $_SERVER['KERNEL_CLASS'] = TestKernel::class;

        $client = static::createClient();

        $client->request('GET', '/alertify/ajax');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}


