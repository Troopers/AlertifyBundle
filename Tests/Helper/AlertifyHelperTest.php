<?php

namespace Troopers\AlertifyBundle\Tests\Helper;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Troopers\AlertifyBundle\Helper\AlertifyHelper;

class AlertifyHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testFlashBagPopulate()
    {
        $session = $this->getSessionMock();
        $helper = new AlertifyHelper($session);
        $helper->alert('Alert', 'success');
        $this->assertEquals([['body' => 'Alert', 'options' => []]], $session->getFlashBag()->get('success'));

        $helper->alert('Alert', 'success');
        $helper->alert('Alert queued', 'success');
        $this->assertEquals([['body' => 'Alert', 'options' => []], ['body' => 'Alert queued', 'options' => []]], $session->getFlashBag()->get('success'));

        $helper->congrat('Congratulation');
        $this->assertEquals([['body' => 'Congratulation', 'options' => []]], $session->getFlashBag()->get('success'));

        $helper->inform('Information');
        $this->assertEquals([['body' => 'Information', 'options' => []]], $session->getFlashBag()->get('info'));

        $helper->warn('Warning');
        $this->assertEquals([['body' => 'Warning', 'options' => []]], $session->getFlashBag()->get('warning'));

        $helper->scold('Danger !');
        $this->assertEquals([['body' => 'Danger !', 'options' => []]], $session->getFlashBag()->get('error'));
    }

    public function testFlashBagWithOptions()
    {
        $session = $this->getSessionMock();
        $helper = new AlertifyHelper($session);
        $helper->alert('Alert', 'success', ['backgroundColor' => 'green']);
        $this->assertEquals([['body' => 'Alert', 'options' => ['backgroundColor' => 'green']]], $session->getFlashBag()->get('success'));

        $helper->congrat('Congratulation', ['backgroundColor' => 'green']);
        $this->assertEquals([['body' => 'Congratulation', 'options' => ['backgroundColor' => 'green']]], $session->getFlashBag()->get('success'));

        $helper->inform('Information', ['backgroundColor' => 'blue']);
        $this->assertEquals([['body' => 'Information', 'options' => ['backgroundColor' => 'blue']]], $session->getFlashBag()->get('info'));

        $helper->warn('Warning', ['backgroundColor' => 'orange']);
        $this->assertEquals([['body' => 'Warning', 'options' => ['backgroundColor' => 'orange']]], $session->getFlashBag()->get('warning'));

        $helper->scold('Danger !', ['backgroundColor' => 'red']);
        $this->assertEquals([['body' => 'Danger !', 'options' => ['backgroundColor' => 'red']]], $session->getFlashBag()->get('error'));
    }

    /**
     * @return Session
     */
    protected function getSessionMock()
    {
        return new Session(new MockArraySessionStorage());
    }
}
