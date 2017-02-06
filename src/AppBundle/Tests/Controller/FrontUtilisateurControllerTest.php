<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontUtilisateurControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/inscription');
    }

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
    }

}
