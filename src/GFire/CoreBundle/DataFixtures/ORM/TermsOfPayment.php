<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\Industry;

class TermsOfPaymentData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager = $this->container->get('gfire_core.manager.terms_of_payment');

        foreach($this->getData() as $data) {
            $object = $manager->create();
            $object->setTitle($data[0]);
            $object->setNumberOfDays($data[1]);
            $manager->update($object);
        }
    }

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function getData(){

        $data = array();
        $data[] = array('0 Day','0');
        $data[] = array('30 Day','30');
        $data[] = array('60 Day','60');
        $data[] = array('90 Days','90');

        return $data;
    }

    public function getOrder()
    {
        return 2;
    }
}