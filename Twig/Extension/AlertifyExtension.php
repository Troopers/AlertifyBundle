<?php

namespace AppVentus\Awesome\AlertifyBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

/**
 * AlertifyExtension
 *
 * @author Paul Andrieux
 */
class AlertifyExtension extends \Twig_Extension
{
    protected $environment;

    /**
     * {@inheritDoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'alertify';
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'alertify' => new \Twig_Filter_Method($this, 'alertifyFilter'),
        );
    }

    /**
     * Alertify filter
     *
     * @param Session $session
     * @return string
     */
    public function alertifyFilter($session)
    {
        //CALL IT IN YOUR CTLR
        $flashes = $session->getFlashBag()->all();

        $renders = array();
        foreach ($flashes as $key => $flash) {
            switch ($key) {
                case 'modal':
                    $renders[$key] = $this->environment->render('AvAwesomeAlertifyBundle:Modal:modal.html.twig',$flash);
                    $session->removeFlash('modal');
                    unset($flashes['modal']);
                break;
                case 'noty':
                    $renders[$key] = $this->environment->render('AvAwesomeAlertifyBundle:Modal:noty.html.twig', $flash);
                    $session->removeFlash('noty');
                    unset($flashes['noty']);
                break;
                case 'toastr':
                    $renders[$key] = $this->environment->render('AvAwesomeAlertifyBundle:Modal:toastr.html.twig', $flash);
                    $session->removeFlash('toastr');
                    unset($flashes['toastr']);
                break;
                case 'callback':
                    $flash['body'] .= $this->environment->render('AvAwesomeAlertifyBundle:Modal:callback.html.twig', $flash);
                    $session->removeFlash('callback');
                    $session->setFlash($flash['type'], $flash);
                    $renders[$key] = $this->alertifyFilter($session);
                break;
                default:
                    if (is_array($flash)) {
                            $renders[$key] = $this->environment->render($key.'.html.twig',$flash);
                            $session->removeFlash($key);
                    }
                    if (! is_array($flash)) {
                        $value = array('type' => 'success', 'layout' => 'bottom-left' ,'body' => $flash);
                        $renders[$key] = $this->environment->render('AvAwesomeAlertifyBundle:Modal:toastr.html.twig', $value);
                        $session->removeFlash($key);
                    }

                    unset($flashes[$key]);
                break;
            }
        }

        return implode(' ', $renders);
    }

}