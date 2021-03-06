<?php

namespace Yoda\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();

        $container = self::$kernel->getContainer();
        $em = $container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('UserBundle:User');
        $userRepo->createQueryBuilder('user')
            ->delete()
            ->getQuery()
            ->execute();

        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Register', $client->getResponse()->getContent());

        $usernameVal = $crawler
            ->filter('#user_register_username')
            ->attr('value');
        $this->assertEquals('Lea', $usernameVal);

        $form = $crawler->selectButton('Register')->form();
        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertRegExp(
            '/This value should not be blank/',
            $client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Register')->form();
        $form['user_register[username]'] = "user5";
        $form['user_register[email]'] = "user5@user.com";
        $form['user_register[plainPassword][first]'] = "User5";
        $form['user_register[plainPassword][second]'] = "User5";

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $this->assertStringContainsString(
            'Welcome to the star',
            $client->getResponse()->getContent()
        );
    }
}
