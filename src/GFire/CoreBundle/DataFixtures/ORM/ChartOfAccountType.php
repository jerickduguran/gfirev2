<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\Industry;

class ChartOfAccountTypeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager = $this->container->get('gfire_core.manager.chartofaccount_type');

        foreach($this->getData() as $data) {
            $object = $manager->create();
            $object->setCode($data[0]);
            $object->setTitle($data[1]);
            $object->setDescription($data[2]);
            $object->setEnabled($data[3]);

            if(isset($data[4]) && is_array($data[4])) {
                foreach($data[4] as $reference_code){
                    if($this->hasReference($reference_code)) {
                        $validation = $this->getReference($reference_code);
                        $object->addValidation($validation);
                    }
                }
            }
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
        $data[] = array('ASSET','Asset','','1',array('ARC','BC','IV','FA','PP','EB','BB','DEP'));
        $data[] = array('LIABILITY','Liability','','1',array('APC','ET','OV'));
        $data[] = array('CAPITAL','Capital','','1');
        $data[] = array('INCOME','Income','','1');
        $data[] = array('EXPENSE','Expense','','1');

        return $data;
    }

    public function getOrder()
    {
        return 20;
    }
}