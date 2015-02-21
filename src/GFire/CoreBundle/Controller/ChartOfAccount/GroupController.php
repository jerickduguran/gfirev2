<?php

namespace GFire\CoreBundle\Controller\ChartOfAccount;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use GFire\CoreBundle\Entity\ChartOfAccount\Group as ChartOfAccountGroup;
use GFire\CoreBundle\Form\Type\ChartOfAccount\GroupType as ChartOfAccountGroupType;

class GroupController extends Controller
{
    /**
     * Lists all ChartOfAccountGroup entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 			=> 'g.code',
                             'title' 			=> 'g.title',
                             'createdat'		=> 'g.createdAt',
                             'updatedat'		=> 'g.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $group_manager  =  $this->get("gfire_core.manager.chartofaccount_group");
        $pager          =  $group_manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:ChartOfAccount/Group:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Groups");

        return $this->render('GFireCoreBundle:ChartOfAccount/Group:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }


    /**
     * Creates a new ChartOfAccountGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $group_manager = $this->get("gfire_core.manager.chartofaccount_group");
        $entity = $group_manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()){
            $group_manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', 'New Group "' . $entity->getTitle() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('chartofaccountgroup_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Group Codes",$this->generateUrl("chartofaccountgroup"));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:ChartOfAccount\Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ChartOfAccountGroup entity.
     *
     * @param ChartOfAccountGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ChartOfAccountGroup $entity)
    {
        $form = $this->createForm(new ChartOfAccountGroupType(), $entity, array(
            'action' => $this->generateUrl('chartofaccountgroup_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new ChartOfAccountGroup entity.
     *
     */
    public function newAction()
    {
        $group_manager = $this->get("gfire_core.manager.chartofaccount_group");
        $entity = $group_manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Group Codes",$this->generateUrl("chartofaccountgroup"));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:ChartOfAccount\Group:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ChartOfAccountGroup entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.chartofaccount_group");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccountGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Group Codes",$this->generateUrl("chartofaccountgroup"));
        $breadcrumbs->addItem("Edit '". $entity->getTitle()."'");

        return $this->render('GFireCoreBundle:ChartOfAccount\Group:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ChartOfAccountGroup entity.
     *
     * @param ChartOfAccountGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ChartOfAccountGroup $entity)
    {
        $form = $this->createForm(new ChartOfAccountGroupType(), $entity, array(
            'action' => $this->generateUrl('chartofaccountgroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        return $form;
    }
    /**
     * Edits an existing ChartOfAccountGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $group_manager = $this->get("gfire_core.manager.chartofaccount_group");
        $entity        = $group_manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccountGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $group_manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getTitle() . '" Successfully Updated.');

            return $this->redirect($this->generateUrl('chartofaccountgroup_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:ChartOfAccount\Group:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ChartOfAccountGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:ChartOfAccountGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ChartOfAccountGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chartofaccountgroup'));
    }

    /**
     * Creates a form to delete a ChartOfAccountGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chartofaccountgroup_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
