<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\Industry;

class ChartOfAccountGroupData  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager = $this->container->get('gfire_core.manager.chartofaccount_group');

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
        $data[] = array('10000001','Cash in-hand and In-bank','','1');
        $data[] = array('10000002','Receivables and Others','','1');
        $data[] = array('10000003','Prepayment and other current asset','','1');
        $data[] = array('10000004','Property and equipment','','1');
        $data[] = array('10000005','Accounts payable trade and others','','1');
        $data[] = array('10000006','Taxes Payable','','1');
        $data[] = array('10000007','Fund Balance','','1');
        $data[] = array('10000008','Accumulated Depreciation','','1');
        $data[] = array('10000009','Revenues','','1');
        $data[] = array('10000010','Expenses','','1');
        $data[] = array('10000011','Non-operating Expenses','','1');
        $data[] = array('10000012','Investments','','1');

        return $data;
    }
    public function getOrder()
    {
        return 1;
    }
}