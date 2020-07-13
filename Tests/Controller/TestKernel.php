<?php

namespace Troopers\AlertifyBundle\Tests\Controller;

use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Troopers\AlertifyBundle\TroopersAlertifyBundle;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SensioFrameworkExtraBundle(),
            new TwigBundle(),
            new TroopersAlertifyBundle(),
        ];

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}
