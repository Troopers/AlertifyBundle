<?php

namespace AppVentus\Awesome\AlertifyBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * AlertifyExtension
 */
class AlertifyExtension extends \Twig_Extension
{
    protected $environment;
    protected $defaultParameters;

    /**
     * {@inheritDoc}
     */
    public function __construct($defaultParameters)
    {
        $this->defaultParameters = $defaultParameters;
    }

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
            'alertify' => new \Twig_Filter_Method($this, 'alertifyFilter', array('needs_environment' => true, 'is_safe' => array('html')))
        );
    }

    /**
     * Alertify filter
     *
     * @param  Session $session
     * @return string
     */
    public function alertifyFilter($environment, Session $session)
    {
        $flashes = $session->getFlashBag()->all();

        $renders = array();
        foreach ($flashes as $type => $flash) {
            if ($type == "callback") {
                foreach ($flash as $key => $currentFlash) {
                    $currentFlash['body'] .= $environment->render('AvAwesomeAlertifyBundle:Modal:callback.html.twig', $currentFlash);
                    $session->getFlashBag()->add($currentFlash['engine'], $currentFlash);
                    $renders[$type . $key] = $this->alertifyFilter($session);
                }
            } else {
                foreach ($flash as $key => $content) {
                    if (is_array($content)) {
                        $parameters = array_merge($this->defaultParameters, $content);
                    } else {
                        $parameters = array_merge($this->defaultParameters, array('body' => $content));
                    }

                    $parameters['type'] = $type;
                    $renders[$type . $key] = $environment->render('AvAwesomeAlertifyBundle:Modal:'.$parameters['engine'].'.html.twig', $parameters);
                }
            }
        }

        return implode(' ', $renders);
    }

}
