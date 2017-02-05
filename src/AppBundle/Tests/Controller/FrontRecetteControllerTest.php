<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontRecetteControllerTest extends WebTestCase
{
    public function testAjout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajout');
    }

}
