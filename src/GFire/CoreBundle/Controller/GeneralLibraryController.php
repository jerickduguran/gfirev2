<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\GeneralLibrary;
use GFire\CoreBundle\Form\GeneralLibraryType;

/**
 * GeneralLibrary controller.
 *
 */
class GeneralLibraryController extends Controller
{

    /**
     * Lists all GeneralLibrary entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		    => 'gl.code',
                              'createdat'		=> 'gl.createdAt',
                              'name' 		    => 'gl.name',
                              'active' 		    => 'gl.active',
                              'contectperson'   => 'gl.contactPerson',
                              'city' 		    => 'gl.addressCity',
                              'email' 		    => 'gl.email',
                              'tinnumber' 		=> 'gl.tinNumber',
                              'updatedat'		=> 'gl.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.general_library");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:GeneralLibrary:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("General Library");


        return $this->render('GFireCoreBundle:GeneralLibrary:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new GeneralLibrary entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_core.manager.general_library");
        $entity   = $manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getName() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('generallibrary_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("General Library",$this->generateUrl('generallibrary'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:GeneralLibrary:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a GeneralLibrary entity.
     *
     * @param GeneralLibrary $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GeneralLibrary $entity)
    {
        $form = $this->createForm(new GeneralLibraryType(), $entity, array(
            'action' => $this->generateUrl('generallibrary_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new GeneralLibrary entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_core.manager.general_library");
        $entity   = $manager->create();

        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("General Library",$this->generateUrl('generallibrary'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:GeneralLibrary:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GeneralLibrary entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.general_library");
        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find General Library entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("General Library",$this->generateUrl('generallibrary'));
        $breadcrumbs->addItem("Edit");

        return $this->render('GFireCoreBundle:GeneralLibrary:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a GeneralLibrary entity.
    *
    * @param GeneralLibrary $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GeneralLibrary $entity)
    {
        $form = $this->createForm(new GeneralLibraryType(), $entity, array(
            'action' => $this->generateUrl('generallibrary_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing GeneralLibrary entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager  =  $this->get("gfire_core.manager.general_library");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find General Library entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getName() . '" Successfully Updated.');
            return $this->redirect($this->generateUrl('generallibrary_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:GeneralLibrary:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a GeneralLibrary entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:GeneralLibrary')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GeneralLibrary entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('generallibrary'));
    }

    /**
     * Creates a form to delete a GeneralLibrary entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generallibrary_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
