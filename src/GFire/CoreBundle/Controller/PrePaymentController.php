<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\PrePayment;
use GFire\CoreBundle\Form\PrePaymentType;

use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * PrePayment controller.
 *
 */
class PrePaymentController extends Controller
{

    /**
     * Lists all PrePayment entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'pp.code',
            'createdat'		=> 'pp.createdAt',
            'title' 		=> 'pp.title',
            'updatedat'		=> 'pp.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.prepayment");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:PrePayment:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Pre Payment");


        return $this->render('GFireCoreBundle:PrePayment:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new PrePayment entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PrePayment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('prepayment_edit', array('id' => $entity->getId())));
        }

        return $this->render('GFireCoreBundle:PrePayment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PrePayment entity.
     *
     * @param PrePayment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PrePayment $entity)
    {
        $form = $this->createForm(new PrePaymentType(), $entity, array(
            'action' => $this->generateUrl('prepayment_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new PrePayment entity.
     *
     */
    public function newAction()
    {
        $entity = new PrePayment();
        $form   = $this->createCreateForm($entity);

        return $this->render('GFireCoreBundle:PrePayment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PrePayment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:PrePayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrePayment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:PrePayment:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PrePayment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:PrePayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrePayment entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:PrePayment:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PrePayment entity.
    *
    * @param PrePayment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PrePayment $entity)
    {
        $form = $this->createForm(new PrePaymentType(), $entity, array(
            'action' => $this->generateUrl('prepayment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing PrePayment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:PrePayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrePayment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('prepayment_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:PrePayment:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PrePayment entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:PrePayment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PrePayment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('prepayment'));
    }

    /**
     * Creates a form to delete a PrePayment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prepayment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
