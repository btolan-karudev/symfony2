<?php

namespace Yoda\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Register', $client->getResponse()->getContent());

        $usernameVal = $crawler
            ->filter('#user_register_username')
            ->attr('value');
        $this->assertEquals('Lea', $usernameVal);

        $form = $crawler->selectButton('Register')->form();
    }
}
