<?php
/**
 * Created by PhpStorm.
 * User: ThinkCenter
 * Date: 18/03/2019
 * Time: 12:11
 */

namespace Yoda\UserBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_form")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error' => $error,
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        //nothing here
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutction()
    {
        //nothing here
    }
}