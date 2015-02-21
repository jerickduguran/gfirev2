<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\ChartOfAccount;
use GFire\CoreBundle\Form\ChartOfAccountType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ChartOfAccount controller.
 *
 */
class ChartOfAccountController extends Controller
{

    /**
     * Lists all ChartOfAccount entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'ca.code',
            'createdat'		=> 'ca.createdAt',
            'title' 		=> 'ca.title',
            'type' 		    => 'ca.type',
            'updatedat'		=> 'ca.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.chartofaccount");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:ChartOfAccount:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Chart Of Accounts");


        return $this->render('GFireCoreBundle:ChartOfAccount:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new ChartOfAccount entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_core.manager.chartofaccount");
        $entity   = $manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('chartofaccount_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Chart Of Account",$this->generateUrl('chartofaccount'));
        $breadcrumbs->addItem("New");


        return $this->render('GFireCoreBundle:ChartOfAccount:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ChartOfAccount entity.
     *
     * @param ChartOfAccount $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ChartOfAccount $entity)
    {
        $form = $this->createForm(new ChartOfAccountType(), $entity, array(
            'action' => $this->generateUrl('chartofaccount_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new ChartOfAccount entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_core.manager.chartofaccount");
        $entity   = $manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Chart Of Account",$this->generateUrl('chartofaccount'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:ChartOfAccount:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing ChartOfAccount entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccount entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:ChartOfAccount:edit.html.twig', array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ChartOfAccount entity.
    *
    * @param ChartOfAccount $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ChartOfAccount $entity)
    {
        $form = $this->createForm(new ChartOfAccountType(), $entity, array(
            'action' => $this->generateUrl('chartofaccount_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        return $form;
    }
    /**
     * Edits an existing ChartOfAccount entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccount entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('chartofaccount_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:ChartOfAccount:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ChartOfAccount entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ChartOfAccount entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chartofaccount'));
    }

    /**
     * Creates a form to delete a ChartOfAccount entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chartofaccount_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
