<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($count, $firstName)
    {
        return $this->render(
            'EventBundle:Default:index.html.twig',
            array(
                'count' => $count,
                'name' => $firstName,
                'ackbar' => "Its a traaaaaaaaaaaaaaap..."
            )
        );
    }
}
