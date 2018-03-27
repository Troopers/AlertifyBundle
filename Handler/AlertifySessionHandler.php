<?php

namespace Troopers\AlertifyBundle\Handler;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * AlertifySessionHandler.
 */
class AlertifySessionHandler
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var array
     */
    private $defaultParameters;

    /**
     * AlertifySessionHandler constructor.
     *
     * @param \Twig_Environment $twig
     * @param array             $defaultParameters
     */
    public function __construct(array $defaultParameters)
    {
        $this->defaultParameters = $defaultParameters;
    }

    /**
     * Alertify .
     *
     * @param \Twig_Environment $this-twig
     * @param Session           $session
     *
     * @return string
     */
    public function handle($session, \Twig_Environment $twig)
    {
        $flashes = $session->getFlashBag()->all();

        $renders = [];
        foreach ($flashes as $type => $flash) {
            foreach ($flash as $key => $content) {
                if (is_array($content)) {
                    $context = isset($content['context']) ? $content['context'] : null;
                    $defaultParameters = self::getDefaultParametersFromContext($context);
                    $parameters = array_replace_recursive($defaultParameters, $content);
                } else {
                    $defaultParameters = self::getDefaultParametersFromContext(null);
                    $parameters = array_replace($defaultParameters, ['body' => $content]);
                }

                $parameters['type'] = $type;
                $renders[$type.$key] = $twig->render('@TroopersAlertify/'.$parameters['engine'].'.html.twig', $parameters);
            }
        }

        return implode(' ', $renders);
    }

    /**
     * Get the configuration for the given context.
     *
     * @param string $context The actual context
     *
     * @return array
     **/
    protected function getDefaultParametersFromContext($context = null)
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
