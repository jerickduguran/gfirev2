<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\Industry;

class IndustryData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager = $this->container->get('gfire_core.manager.industry');

        foreach($this->getData() as $data) {
            $object = $manager->create();
            $object->setCode($data[0]);
            $object->setTitle($data[1]);
            $object->setDescription($data[2]);
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
        $data[] = array('IT','Information Technology','','1');
        $data[] = array('Audit','Auditing','','1');
        $data[] = array('Accounting','Accounting','','1');
        $data[] = array('Government','Government','','1');

        return $data;
    }

    public function getOrder()
    {
        return 2;
    }
}