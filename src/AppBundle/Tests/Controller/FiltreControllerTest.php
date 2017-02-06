<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiltreControllerTest extends WebTestCase
{
    public function testFiltre()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/filtre');
    }

}
