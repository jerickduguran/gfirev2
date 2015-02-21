<?php

namespace GFire\InvoiceBundle\Entity\Manager;


use GFire\CoreBundle\Entity\Manager\BaseManager;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceAccountEntryInterface;
use GFire\InvoiceBundle\Entity\Interfaces\InvoiceInterface;

use GFire\CoreBundle\Library\Sonata\Pager;
use GFire\CoreBundle\Library\Sonata\ProxyQuery\Doctrine\ProxyQuery;

class InvoiceAccountEntryManager extends BaseManager implements InvoiceAccountEntryManagerInterface
{
    public function getConnection()
    {
        return $this->getObjectManager()->getConnection();
    }

    public function update(InvoiceAccountEntryInterface $group, $andFlush = true)
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

    public function findByInvoiceId($invoice_id = 0)
    {
        return $this->findBy(array("invoice" => $invoice_id));
    }

    public function findAllByInvoicePager($invoice_id = 0, $page = 0, $limit = 10, $params = array())
    {
        if(!isset($params['sort_field'])){
            $params['sort_field'] = 'iae.createdAt';
        }
        if(!isset($params['sort_order'])){
            $params['sort_order'] = 'DESC';
        }

        $query = $this->getRepository()
                      ->createQueryBuilder('iae')
                      ->where('iae.invoice=:invoice')
                      ->setParameter('invoice',$invoice_id);

        if(isset($params['search_params']) && count($params['search_params']) > 0){
            $filters 	  = '';
            $filter_value = $params['search_value'];
            foreach($params['search_params'] as $operand=>$fields){
                foreach($fields as $field){
                    if($filters != '')
                        $filters .= " OR {$field} {$operand} '%{$filter_value}%' ";
                    else
                        $filters .= " {$field} {$operand} '%{$filter_value}%' ";
                }
            }
            $query = $query->andWhere($filters);
        }

        $query->orderBy($params['sort_field'],$params['sort_order']);

        $pager = new Pager();
        $pager->setMaxPerPage($limit);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function findAllPager($page = 0, $limit = 10, $params = array())
    {
        if(!isset($params['sort_field'])){
            $params['sort_field'] = 'iae.createdAt';
        }
        if(!isset($params['sort_order'])){
            $params['sort_order'] = 'DESC';
        }

        $query = $this->getRepository()
                      ->createQueryBuilder('iae');

        $query->orderBy($params['sort_field'],$params['sort_order']);

        $pager = new Pager();
        $pager->setMaxPerPage($limit);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

}