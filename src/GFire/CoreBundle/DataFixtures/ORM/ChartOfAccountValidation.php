<?php

namespace GFire\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GFire\CoreBundle\Entity\ChartOfAccount\Validation;

class ChartOfAccountValidationData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $validation_manager = $this->container->get('gfire_core.manager.chartofaccount_validation');

        foreach($this->getData() as $data) {
            $validation = $validation_manager->create();
            $validation->setCode($data[0]);
            $validation->setName($data[1]);
            $validation->setDescription($data[2]);
            $validation->setEnabled($data[3]);
            $validation_manager->update($validation,false);

            $this->setReference($validation->getCode(), $validation);
        }
    }

    /**
     * @var ContainerInterfacew
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
        $data[] = array('ARC','AR Codes','Accounts receivable Codes','1');
        $data[] = array('BC','Bank / Cash','Accounts receivable Codes','1');
        $data[] = array('ALLC','Allocation','Accounts receivable Codes','1');
        $data[] = array('IV','Input VAT','Accounts receivable Codes','1');
        $data[] = array('FA','Fixed Asset','Accounts receivable Codes','1');
        $data[] = array('PP','Prepayment','Accounts receivable Codes','1');
        $data[] = array('GL','Gain / Loss','Accounts receivable Codes','1');
        $data[] = array('RS','Restatement','Accounts receivable Codes','1');
        $data[] = array('APC','AP Code','Accounts receivable Codes','1');
        $data[] = array('ET','Expanded Tax','Accounts receivable Codes','1');
        $data[] = array('FT','Final Tax','Accounts receivable Codes','1');
        $data[] = array('OV','Output VAT','Accounts receivable Codes','1');
        $data[] = array('EB','Ending Balance','Accounts receivable Codes','1');
        $data[] = array('BB','Beginning Balance','Accounts receivable Codes','1');
        $data[] = array('DEP','Depreciation','Accounts receivable Codes','1');

        return $data;

    }

    public function getOrder()
    {
        return 10;
    }
}