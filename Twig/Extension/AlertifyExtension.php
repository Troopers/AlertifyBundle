<?php

namespace AppVentus\Awesome\AlertifyBundle\Twig\Extension;
/**
 * Description of AlertifyExtension
 *
 * @author paul
 */
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
 
class AlertifyExtension extends \Twig_Extension
{
    protected $environment;
    
    
    public function initRuntime(\Twig_Environment $environment)
        {
       
            $this->environment = $environment;
        }

    public function getName()
    {
        return 'alertify';
    }
    
    public function getFilters()
    {
        return array(
            'alertify' => new \Twig_Filter_Method($this, 'alertifyFilter'),
        );
    }
    
    public function alertifyFilter($session)
    {
        //CALL IT IN YOUR CTLR
        //$this->container->get('session')->setFlash('modal', array('title' => 'test', 'body'=>'test body', 'button_class'=>'boutonmoyen')); 
        $flashes = $session->getFlashes();
        $renders = array();
        foreach($flashes as $key => $flash){
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
                    case 'callback':
                        $flash['body'] .= $this->environment->render('AvAwesomeAlertifyBundle:Modal:callback.html.twig', $flash);
                        $session->removeFlash('callback');
                        $session->setFlash($flash['type'], $flash);
                        $renders[$key] = $this->alertifyFilter($session);
                    break;
                default:
                    return false;
                    break;
            }
        }
        return implode(" ", $renders);
    }
    
}

?>
