<?php

namespace AppVentus\AlertifyBundle\Twig\Extension;

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
     * @param TwigEnvironment $environment
     * @param Session         $session
     *
     * @return string
     */
    public function alertifyFilter($environment, Session $session)
    {
        $flashes = $session->getFlashBag()->all();

        $renders = array();
        foreach ($flashes as $type => $flash) {
            if ($type == "callback") {
                foreach ($flash as $key => $currentFlash) {
                    $currentFlash['body'] .= $environment->render('AvAlertifyBundle:Modal:callback.html.twig', $currentFlash);
                    $session->getFlashBag()->add($currentFlash['engine'], $currentFlash);
                    $renders[$type . $key] = $this->alertifyFilter($environment, $session);
                }
            } else {
                foreach ($flash as $key => $content) {
                    if (is_array($content)) {
                        $context = isset($content['context']) ? $content['context'] : null;
                        $defaultParameters = self::getDefaultParametersFromContext($context);
                        $parameters = array_merge($defaultParameters, $content);
                    } else {
                        $defaultParameters = self::getDefaultParametersFromContext(null);
                        $parameters = array_merge($defaultParameters, array('body' => $content));
                    }

                    $parameters['type'] = $type;
                    $renders[$type . $key] = $environment->render('AvAlertifyBundle:Modal:'.$parameters['engine'].'.html.twig', $parameters);
                }
            }
        }

        return implode(' ', $renders);
    }

    /**
      * Get the configuration for the given context
      * @param string $context The actual context
      *
      * @return array
      **/
    public function getDefaultParametersFromContext($context = null)
    {
        if (count($this->defaultParameters['contexts'])) {
            //If context is not given, just take the default one
            if ($context === null) {
                $context = $this->defaultParameters['default']['context'];
            }

            //If context is in declared contexts, we use it
            if (array_key_exists($context, $this->defaultParameters['contexts'])) {
                return $this->defaultParameters['contexts'][$context];
            }
        }

        //else we return the default configuration
        return $this->defaultParameters['default'];

    }

}
