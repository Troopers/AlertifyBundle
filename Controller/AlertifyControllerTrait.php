<?php

namespace Troopers\AlertifyBundle\Controller;

use Symfony\Component\DependencyInjection\Container;

/**
 * @property Container container
 */
trait AlertifyControllerTrait
{
    /**
     * Alert message to flash bag.
     *
     * @param string $content
     * @param string $type
     * @param array  $options
     */
    public function alert($content, $type = 'success', $options = [])
    {
        $this->container->get('alertify')->alert($content, $type, $options);
    }

    /**
     * Congrats user through flash bag : all happened successfully.
     *
     * @param string $content
     * @param array  $options
     */
    public function congrat($content, $options = [])
    {
        $this->container->get('alertify')->congrat($content, $options);
    }

    /**
     * Warn user through flash bag: something requires attention.
     *
     * @param string $content
     * @param array  $options
     */
    public function warn($content, $options = [])
    {
        $this->container->get('alertify')->warn($content, $options);
    }

    /**
     * Inform user through flash bag: something have to be said.
     *
     * @param string $content
     * @param array  $options
     */
    public function inform($content, $options = [])
    {
        $this->container->get('alertify')->inform($content, $options);
    }

    /**
     * Scold user through flash bag: something went wrong.
     *
     * @param string $content
     * @param array  $options
     */
    public function scold($content, $options = [])
    {
        $this->container->get('alertify')->scold($content, $options);
    }
}
