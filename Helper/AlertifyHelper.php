<?php

namespace Troopers\AlertifyBundle\Helper;

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

    /**
     * Alert message to flash bag.
     *
     * @param string $content
     * @param string $type
     * @param array  $options
     */
    public function alert($content, $type = 'success', $options = [])
    {
        if (!is_array($content)) {
            $content = [
                'body' => $content,
            ];
        }

        $content = array_merge($content, [
            'options' => $options,
        ]);

        $this->session->getFlashBag()->add($type, $content);
    }

    /**
     * Congrats user through flash bag : all happened successfully.
     *
     * @param string|array $content
     * @param array        $options
     */
    public function congrat($content, $options = [])
    {
        $this->alert($content, 'success', $options);
    }

    /**
     * Warn user through flash bag: something requires attention.
     *
     * @param string|array $content
     * @param array        $options
     */
    public function warn($content, $options = [])
    {
        $this->alert($content, 'warning', $options);
    }

    /**
     * Inform user through flash bag: something have to be said.
     *
     * @param string|array $content
     * @param array        $options
     */
    public function inform($content, $options = [])
    {
        $this->alert($content, 'info', $options);
    }

    /**
     * Scold user through flas hbag: something went wrong.
     *
     * @param string|array $content
     * @param array        $options
     */
    public function scold($content, $options = [])
    {
        $this->alert($content, 'error', $options);
    }
}
