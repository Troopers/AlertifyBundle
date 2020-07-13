<?php

namespace Troopers\AlertifyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Alertify controller.
 */
class AlertifyController extends AbstractController
{
    /**
     * Confirm modal.
     *
     * @param Request $request An HTTP request.
     * @Route("/confirm", name="alertify_confirm", options={"expose"=true})
     *
     * @return Response
     */
    public function confirmAction(Request $request)
    {
        $confirmCallback = $request->get('confirm_callback');
        if ($confirmCallback === '') {
            $confirmCallback = null;
        }

        return $this->render('@TroopersAlertify/confirm.html.twig', [
            'title'                => $request->get('title'),
            'body'                 => $request->get('body'),
            'id'                   => $request->get('id').rand(1, 100).'-modal',
            'cancel_button_class'  => $request->get('cancel_button_class', 'btn-cancel'),
            'confirm_button_class' => $request->get('confirm_button_class', 'btn-primary'),
            'cancel_button_value'  => $request->get('cancel_button_value'),
            'confirm_button_value' => $request->get('confirm_button_value'),
            'modal_class'          => $request->get('modal_class'),
            'type'                 => $request->get('type'),
            'confirmCallback'      => $confirmCallback,
        ]);
    }

    /**
     * Ajax.
     *
     * @param Request $request An HTTP request.
     * @Route("/ajax", name="alertify_ajax", options={"expose"=true})
     *
     * @return Response
     */
    public function ajaxAction(Request $request)
    {
        $options = [];
        if ($context = $request->request->get('context')) {
            $options = $this->container->getParameter('troopers_alertify.contexts.'.$context);
        }

        foreach ($request->request->all() as $name => $option) {
            $options[$name] = $option;
        }

        if ($request->get('main_type')) {
            $this->get('session')->getFlashBag()->add($request->get('main_type'), $options);
        }

        return $this->render('@TroopersAlertify/ajax.html.twig');
    }
}
