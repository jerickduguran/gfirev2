<?php

namespace GFire\CoreBundle\Entity\Manager;


use GFire\CoreBundle\Entity\Manager\BaseManager;
use GFire\CoreBundle\Entity\Manager\CurrencyManagerInterface;
use GFire\CoreBundle\Entity\Currency;
use GFire\CoreBundle\Entity\Interfaces\CurrencyInterface;

use GFire\CoreBundle\Library\Sonata\Pager;
use GFire\CoreBundle\Library\Sonata\ProxyQuery\Doctrine\ProxyQuery;

class CurrencyManager extends BaseManager implements CurrencyManagerInterface
{
    public function getConnection()
    {
        return $this->getObjectManager()->getConnection();
    }

    public function update(CurrencyInterface $group, $andFlush = true)
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
            $params['sort_field'] = 'c.createdAt';
        }
        if(!isset($params['sort_order'])){
            $params['sort_order'] = 'DESC';
        }

        $query = $this->getRepository()
                      ->createQueryBuilder('c');

        $query->orderBy($params['sort_field'],$params['sort_order']);

        $pager = new Pager();
        $pager->setMaxPerPage($limit);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

}