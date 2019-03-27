<?php

namespace Yoda\EventBundle\Controller;


class DefaultController extends Controller
{
    public function indexAction($count, $firstName)
    {
//        $em = $this->container->get('doctrine')->getManager();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');

        $event = $repo->findOneBy(array(
           'name' => 'Darth surprise birthday!'
        ));

        return $this->render(
            'EventBundle:Default:index.html.twig',
            array(
                'count' => $count,
                'name' => $firstName,
                'event' => $event
            )
        );
    }
}
