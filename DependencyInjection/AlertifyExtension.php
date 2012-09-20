<?php
/**
 * Description of AlertifyExtension
 *
 * @author paul
 */
namespace AppVentus\Awesome\AleryifyBundle\DependencyInjection;
 
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
 
class AlertifyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
?>
