<?php

namespace GFire\CoreBundle\Controller\ChartOfAccount;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use GFire\CoreBundle\Entity\ChartOfAccount\Type;
use GFire\CoreBundle\Form\ChartOfAccount\TypeType;

/**
 * ChartOfAccount\Type controller.
 *
 */
class TypeController extends Controller
{

    /**
     * Lists all ChartOfAccount\Type entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 	=> 'ct.code',
                      'title' 			=> 'ct.title',
                      'createdat'		=> 'ct.createdAt',
                      'updatedat'		=> 'ct.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $group_manager  =  $this->get("gfire_core.manager.chartofaccount_type");
        $pager          =  $group_manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:ChartOfAccount/Type:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Groups");



        return $this->render('GFireCoreBundle:ChartOfAccount/Type:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new ChartOfAccount\Type entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Type();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chartofaccount_type_edit', array('id' => $entity->getId())));
        }

        return $this->render('GFireCoreBundle:ChartOfAccount/Type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ChartOfAccount\Type entity.
     *
     * @param Type $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Type $entity)
    {
        $form = $this->createForm(new TypeType(), $entity, array(
            'action' => $this->generateUrl('chartofaccount_type_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ChartOfAccount\Type entity.
     *
     */
    public function newAction()
    {
        $entity = new Type();
        $form   = $this->createCreateForm($entity);

        return $this->render('GFireCoreBundle:ChartOfAccount/Type:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ChartOfAccount\Type entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount\Type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccount\Type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:ChartOfAccount/Type:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ChartOfAccount\Type entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount\Type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccount\Type entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GFireCoreBundle:ChartOfAccount/Type:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ChartOfAccount\Type entity.
    *
    * @param Type $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Type $entity)
    {
        $form = $this->createForm(new TypeType(), $entity, array(
            'action' => $this->generateUrl('chartofaccount_type_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ChartOfAccount\Type entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount\Type')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ChartOfAccount\Type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('chartofaccount_type_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:ChartOfAccount/Type:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ChartOfAccount\Type entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:ChartOfAccount\Type')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ChartOfAccount\Type entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chartofaccount_type'));
    }

    /**
     * Creates a form to delete a ChartOfAccount\Type entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chartofaccount_type_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
