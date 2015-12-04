<?php

namespace AppVentus\AlertifyBundle\Helper;

use Symfony\Component\HttpFoundation\Session\Session;

class AlertifyHelper
{
    protected $session = null;

    /**
     * Constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /*
     * Alert message to flash bag.
     * @param string $content Captain Obvious ? We have to setup a content
     * @param string $type    Success or Error ? Warning or Info ? You choose !
     */

    public function alert($content, $type = 'success')
    {
        $this->session->getFlashBag()->add($type, $content);
    }

    /**
     * Congrats user through flash bag : all happened successfully.
     *
     * @param string|array $content
     */
    public function congrat($content)
    {
        $this->session->getFlashBag()->add('success', $content);
    }

    /**
     * Warn user through flash bag: something requires attention.
     *
     * @param string|array $content
     */
    public function warn($content)
    {
        $this->session->getFlashBag()->add('warning', $content);
    }

    /**
     * Inform user through flash bag: something have to be said.
     *
     * @param string|array $content
     */
    public function inform($content)
    {
        $this->session->getFlashBag()->add('info', $content);
    }

    /**
     * Scold user through flas hbag: something went wrong.
     *
     * @param string|array $content
     */
    public function scold($content)
    {
        $this->session->getFlashBag()->add('error', $content);
    }
}
