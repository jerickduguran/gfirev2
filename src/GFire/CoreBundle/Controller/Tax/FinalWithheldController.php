<?php

namespace GFire\CoreBundle\Controller\Tax;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\Tax\FinalWithheld;
use GFire\CoreBundle\Form\Tax\FinalWithheldType;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Tax\FinalWithheld controller.
 *
 */
class FinalWithheldController extends Controller
{

    /**
     * Lists all Tax\FinalWithheld entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		        => 'ft.code',
                             'createdat'		    => 'ft.createdAt',
                             'title' 		        => 'ft.title',
                             'natureofincomepayment'=> 'et.natureOfIncomePayment',
                             'updatedat'		    => 'ft.updatedAt');

        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.tax_finalwithheld");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:Tax/FinalWithheld:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Tax Final Withheld");


        return $this->render('GFireCoreBundle:Tax/FinalWithheld:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));

    }
    /**
     * Creates a new Tax\FinalWithheld entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FinalWithheld();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tax_finalwithheld_edit', array('id' => $entity->getId())));
        }

        return $this->render('GFireCoreBundle:Tax/FinalWithheld:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tax\FinalWithheld entity.
     *
     * @param FinalWithheld $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FinalWithheld $entity)
    {
        $form = $this->createForm(new FinalWithheldType(), $entity, array(
            'action' => $this->generateUrl('tax_finalwithheld_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Tax\FinalWithheld entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_core.manager.tax_finalwithheld");
        $entity   = $manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Tax Final Withheld",$this->generateUrl('tax_finalwithheld'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:Tax/FinalWithheld:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Tax\FinalWithheld entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.tax_finalwithheld");
        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tax Final Withheld entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Tax Final Withheld",$this->generateUrl('tax_finalwithheld'));
        $breadcrumbs->addItem("Edit");

        return $this->render('GFireCoreBundle:Tax/FinalWithheld:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tax\FinalWithheld entity.
    *
    * @param FinalWithheld $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FinalWithheld $entity)
    {
        $form = $this->createForm(new FinalWithheldType(), $entity, array(
            'action' => $this->generateUrl('tax_finalwithheld_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Tax\FinalWithheld entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager  =  $this->get("gfire_core.manager.tax_finalwithheld");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tax Final Withheld entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Updated.');
            return $this->redirect($this->generateUrl('tax_finalwithheld_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:Tax/FinalWithheld:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tax\FinalWithheld entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:Tax\FinalWithheld')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tax\FinalWithheld entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tax_finalwithheld'));
    }

    /**
     * Creates a form to delete a Tax\FinalWithheld entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tax_finalwithheld_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
