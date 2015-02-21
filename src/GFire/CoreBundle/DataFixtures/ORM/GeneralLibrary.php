<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\Industry;

class GeneralLibraryData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager = $this->container->get('gfire_core.manager.general_library');

        foreach($this->getData() as $data) {
            $object = $manager->create();
            $object->setCode($data[0]);
            $object->setName($data[1]);
            $object->setActive($data[2]);
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

        $data   = array();
        $data[] = array('15-00000001','Caltext Philippines','1');
        $data[] = array('15-00000002','Mitsubishi Cars, Philippines','1');
        $data[] = array('15-00000003','Proctle and Gumble Philippines','1');

        return $data;
    }

    public function getOrder()
    {
        return 2;
    }
}