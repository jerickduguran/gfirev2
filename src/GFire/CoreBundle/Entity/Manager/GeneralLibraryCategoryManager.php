<?php

namespace GFire\CoreBundle\Entity\Manager;


use GFire\CoreBundle\Entity\Interfaces\GeneralLibraryCategoryInterface;
use GFire\CoreBundle\Entity\Manager\GeneralLibraryCategoryManagerInterface;
use GFire\CoreBundle\Entity\Manager\BaseManager;
use GFire\CoreBundle\Entity\GeneralLibrary\Category;

use GFire\CoreBundle\Library\Sonata\Pager;
use GFire\CoreBundle\Library\Sonata\ProxyQuery\Doctrine\ProxyQuery;

class GeneralLibraryCategoryManager extends BaseManager implements GeneralLibraryCategoryManagerInterface
{
    public function getConnection()
    {
        return $this->getObjectManager()->getConnection();
    }

    public function update(GeneralLibraryCategoryInterface $group, $andFlush = true)
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
            $params['sort_field'] = 'glc.createdAt';
        }
        if(!isset($params['sort_order'])){
            $params['sort_order'] = 'DESC';
        }

        $query = $this->getRepository()
                      ->createQueryBuilder('glc');

        $query->orderBy($params['sort_field'],$params['sort_order']);

        $pager = new Pager();
        $pager->setMaxPerPage($limit);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

}