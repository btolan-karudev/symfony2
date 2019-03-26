<?php
/**
 * Created by PhpStorm.
 * User: ThinkCenter
 * Date: 25/03/2019
 * Time: 12:42
 */

namespace Yoda\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Yoda\UserBundle\Entity\User;
use Yoda\UserBundle\Form\RegisterFormType;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
       $user = new User();
       $user->setUsername('Lea');

        $form = $this->createForm(new RegisterFormType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->authenticateUser($user);

            $request->getSession()->getFlashbag()
                ->add('success', 'Welcome to the star! have a magical day!');

            $url = $this->generateUrl('event');

            return $this->redirect($url);
        }

        return array('form' => $form->createView());
    }

    private function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);
        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    private function authenticateUser(User $user)
    {
        $providerKey = 'secured_area'; // your firewall name
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.context')->setToken($token);
    }
}