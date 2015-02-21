<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\Currency;
use GFire\CoreBundle\Form\CurrencyType;

use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Currency controller.
 *
 */
class CurrencyController extends Controller
{

    /**
     * Lists all Currency entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('symbol' 		=> 'c.symbol',
            'createdat'		=> 'c.createdAt',
            'name' 		=> 'c.name',
            'updatedat'		=> 'c.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.currency");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:Currency:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Currency");


        return $this->render('GFireCoreBundle:Currency:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new Currency entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Currency();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_edit', array('id' => $entity->getId())));
        }

        return $this->render('GFireCoreBundle:Currency:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Currency entity.
     *
     * @param Currency $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Currency $entity)
    {
        $form = $this->createForm(new CurrencyType(), $entity, array(
            'action' => $this->generateUrl('currency_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Currency entity.
     *
     */
    public function newAction()
    {
        $entity = new Currency();
        $form   = $this->createCreateForm($entity);

        return $this->render('GFireCoreBundle:Currency:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Currency entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:Currency:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Currency entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:Currency:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Currency entity.
    *
    * @param Currency $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Currency $entity)
    {
        $form = $this->createForm(new CurrencyType(), $entity, array(
            'action' => $this->generateUrl('currency_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Currency entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('currency_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:Currency:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Currency entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:Currency')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Currency entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('currency'));
    }

    /**
     * Creates a form to delete a Currency entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('currency_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
