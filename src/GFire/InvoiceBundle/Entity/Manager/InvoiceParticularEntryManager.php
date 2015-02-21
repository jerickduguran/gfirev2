<?php

namespace GFire\InvoiceBundle\Entity\Manager;


use GFire\CoreBundle\Entity\Manager\BaseManager;
use GFire\InvoiceBundle\Entity\Manager\InvoiceParticularEntryManagerInterface;
use GFire\InvoiceBundle\Entity\InvoiceParticularEntry;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceParticularEntryInterface;

use GFire\CoreBundle\Library\Sonata\Pager;
use GFire\CoreBundle\Library\Sonata\ProxyQuery\Doctrine\ProxyQuery;

class InvoiceParticularEntryManager extends BaseManager implements InvoiceParticularEntryManagerInterface
{
    public function getConnection()
    {
        return $this->getObjectManager()->getConnection();
    }

    public function update(InvoiceParticularEntryInterface $group, $andFlush = true)
    {
        $this->getObjectManager()->persist($group);
        if ($andFlush) {
            $this->getObjectManager()->flush();
        }
    }

    public function create()
    {
        $class = $this->getClass();
        $obj   = new $class;

        return $obj;
    }


    public function findAllPager($page = 0, $limit = 10, $params = array())
    {
        if(!isset($params['sort_field'])){
            $params['sort_field'] = 'ipe.createdAt';
        }
        if(!isset($params['sort_order'])){
            $params['sort_order'] = 'DESC';
        }

        $query = $this->getRepository()
                      ->createQueryBuilder('ipe');

        $query->orderBy($params['sort_field'],$params['sort_order']);

        $pager = new Pager();
        $pager->setMaxPerPage($limit);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

}