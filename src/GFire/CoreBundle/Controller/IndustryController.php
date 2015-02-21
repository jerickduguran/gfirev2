<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use GFire\CoreBundle\Entity\Industry;
use GFire\CoreBundle\Form\Type\IndustryType;

/**
 * Industry controller.
 *
 */
class IndustryController extends Controller
{

    /**
     * Lists all Industry entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'i.code',
                            'createdat'		=> 'i.createdAt',
                            'title' 		=> 'i.title',
                            'updatedat'		=> 'i.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.industry");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:Industry:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Industry");


        return $this->render('GFireCoreBundle:Industry:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));

    }
    /**
     * Creates a new Industry entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_core.manager.industry");
        $entity   = $manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('industry_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Industry",$this->generateUrl('industry'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:Industry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Industry entity.
     *
     * @param Industry $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Industry $entity)
    {
        $form = $this->createForm(new IndustryType(), $entity, array(
            'action' => $this->generateUrl('industry_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Industry entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_core.manager.industry");
        $entity   = $manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Industry",$this->generateUrl('industry'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:Industry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Industry entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.industry");
        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Industry entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Industry",$this->generateUrl('industry'));
        $breadcrumbs->addItem("Edit");

        return $this->render('GFireCoreBundle:Industry:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Industry entity.
    *
    * @param Industry $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Industry $entity)
    {
        $form = $this->createForm(new IndustryType(), $entity, array(
            'action' => $this->generateUrl('industry_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Industry entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager  =  $this->get("gfire_core.manager.industry");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Industry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Updated.');
            return $this->redirect($this->generateUrl('industry_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:Industry:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Industry entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:Industry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Industry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('industry'));
    }

    /**
     * Creates a form to delete a Industry entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('industry_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
