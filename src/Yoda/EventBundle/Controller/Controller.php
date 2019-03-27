<?php
/**
 * Created by PhpStorm.
 * User: ThinkCenter
 * Date: 27/03/2019
 * Time: 12:16
 */

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Yoda\EventBundle\Entity\Event;

class Controller extends BaseController
{
    public function getSecurityContext()
    {
        return $this->container->get('security.context');
    }

    public function enforceOwnerSecurity(Event $event)
    {
        $user = $this->getUser();

        if ($user != $event->getOwner()) {
            throw new AccessDeniedException('You do not own this!');
        }
    }
}