<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\Department;
use GFire\CoreBundle\Form\DepartmentType;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Department controller.
 *
 */
class DepartmentController extends Controller
{

    /**
     * Lists all Department entities.
     *
     */
    /**
     * Lists all Project entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'd.code',
            'createdat'		=> 'd.createdAt',
            'title' 		=> 'd.title',
            'updatedat'		=> 'd.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.department");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:Department:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Department");


        return $this->render('GFireCoreBundle:Department:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));

    }
    /**
     * Creates a new Department entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_core.manager.department");
        $entity   = $manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('department_edit', array('id' => $entity->getId())));
        }


        return $this->render('GFireCoreBundle:Department:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Department entity.
     *
     * @param Department $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Department $entity)
    {
        $form = $this->createForm(new DepartmentType(), $entity, array(
            'action' => $this->generateUrl('department_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Department entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_core.manager.department");
        $entity   =  $manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Departments",$this->generateUrl('department'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:Department:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Department entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.department");
        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Department entity.');
        }

        $editForm   = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Department",$this->generateUrl('department'));
        $breadcrumbs->addItem("Edit");


        return $this->render('GFireCoreBundle:Department:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Department entity.
    *
    * @param Department $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Department $entity)
    {
        $form = $this->createForm(new DepartmentType(), $entity, array(
            'action' => $this->generateUrl('department_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Department entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager  = $this->get("gfire_core.manager.department");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Department entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Updated.');
            return $this->redirect($this->generateUrl('department_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:Department:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Department entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:Department')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Department entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('department'));
    }

    /**
     * Creates a form to delete a Department entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('department_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
