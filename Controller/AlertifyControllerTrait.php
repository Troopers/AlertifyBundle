<?php

namespace AppVentus\AlertifyBundle\Controller;

/**
 * @property Container container
 */
trait AlertifyControllerTrait
{
    /**
     * Alert message to flash bag.
     *
     * @param string $content Captain Obvious ? We have to setup a content
     * @param string $type    Success or Error ? Warning or Info ? You choose !
     */
    public function alert($content, $type = 'success')
    {
        $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->alert($content, $type);
    }

    /**
     * Congrats user through flash bag : all happened successfully.
     *
     * @param string $content
     */
    public function congrat($content)
    {
        $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->congrat($content);
    }

    /**
     * Warn user through flash bag: something requires attention.
     *
     * @param string $content
     */
    public function warn($content)
    {
        $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->warn($content);
    }

    /**
     * Inform user through flash bag: something have to be said.
     *
     * @param string $content
     */
    public function inform($content)
    {
        $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->inform($content);
    }

    /**
     * Scold user through flash bag: something went wrong.
     *
     * @param string $content
     */
    public function scold($content)
    {
        $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->scold($content);
    }
}
