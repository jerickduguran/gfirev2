<?php

namespace GFire\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('GFireSiteBundle:Index:index.html.twig');
    }
}
