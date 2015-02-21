<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\FixAsset;
use GFire\CoreBundle\Form\FixAssetType;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * FixAsset controller.
 *
 */
class FixAssetController extends Controller
{

    /**
     * Lists all FixAsset entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'fa.code',
            'createdat'		=> 'fa.createdAt',
            'title' 		=> 'fa.title',
            'updatedat'		=> 'fa.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.fixasset");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:FixAsset:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Fix Asset");


        return $this->render('GFireCoreBundle:FixAsset:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new FixAsset entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FixAsset();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fixasset_edit', array('id' => $entity->getId())));
        }

        return $this->render('GFireCoreBundle:FixAsset:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FixAsset entity.
     *
     * @param FixAsset $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FixAsset $entity)
    {
        $form = $this->createForm(new FixAssetType(), $entity, array(
            'action' => $this->generateUrl('fixasset_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new FixAsset entity.
     *
     */
    public function newAction()
    {
        $entity = new FixAsset();
        $form   = $this->createCreateForm($entity);

        return $this->render('GFireCoreBundle:FixAsset:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FixAsset entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:FixAsset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FixAsset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:FixAsset:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FixAsset entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:FixAsset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FixAsset entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:FixAsset:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FixAsset entity.
    *
    * @param FixAsset $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FixAsset $entity)
    {
        $form = $this->createForm(new FixAssetType(), $entity, array(
            'action' => $this->generateUrl('fixasset_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing FixAsset entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:FixAsset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FixAsset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fixasset_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:FixAsset:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FixAsset entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:FixAsset')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FixAsset entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fixasset'));
    }

    /**
     * Creates a form to delete a FixAsset entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fixasset_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
