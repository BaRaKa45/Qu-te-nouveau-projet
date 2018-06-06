<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 31/05/18
 * Time: 17:41
 */

namespace AppBundle\Service;


class Mailer
{

    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $receiver
     * @param $pilot
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendEmail($receiver, $notification)
    {
        $notification ? $render = 'email/notification.html.twig': $render = 'email/reservation.html.twig';

        $body = $this->templating->render($render, ['receiver' => $receiver]);

        $message = (new \Swift_Message('Reservation Flyaround'))
            ->setFrom('reservation@flyaround.com')
            ->setTo($receiver)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }
}