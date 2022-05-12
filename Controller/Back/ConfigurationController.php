<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace HookFetes\Controller\Back;

use Symfony\Component\HttpFoundation\JsonResponse;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Log\Tlog;
use HookFetes\Model\AgendaFetes;
use HookFetes\Model\AgendaFetesQuery;
use HookFetes\Form\FetesUpdateForm;
use Thelia\Tools\URL;

/**
 * Class Configuration
 * @package HookFetes\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */
class ConfigurationController extends BaseAdminController
{
    public function saveAction()
    {
        Tlog::getInstance()->addInfo(str(" save "));
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['hookfetes'], AccessManager::CREATE)) {
            return $response;
        }
        $request = $this->getRequest();
        $maxpos = AgendaFetesQuery::create()->findMaxPosition();
        $form = $this->createForm('fetes.add.form');
         try {
            $add_form=$this->validateForm($form);
            $agendaModel=new AgendaFetes();
            $agendaModel->setTitle($add_form->getData()['title']);
            $agendaModel->setDepartement($add_form->getData()['department']);
            $agendaModel->setVille($add_form->getData()['city']);
            $agendaModel->setDebut($add_form->getData()['begin']);
            $agendaModel->setFin($add_form->getData()['end']);
            $agendaModel->setLien($add_form->getData()['url']); 
            $agendaModel->setPosition($maxpos + 1);
            $agendaModel->Save();
        } 
        catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        }

        $error_message = null;
        $resp = array(
            "error" =>  0,
            "message" => ""
        );
       
       
       return $this->render('module_add');
   }
   public function saveUpdateAction()
    {
        Tlog::getInstance()->addInfo(str(" saveupdate "));
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['hookfetes'], AccessManager::CREATE)) {
            return $response;
        }
        $request = $this->getRequest();
        $maxpos = AgendaFetesQuery::create()->findMaxPosition();
        Tlog::getInstance()->addInfo(str("position maximale saveupdate : ".$maxpos));
        $form = $this->createForm('fetes.update.form');
        try {
            $update_form=$this->validateForm($form);
            $data = $update_form->getData();
           // var_dump($data);
            $agendaModel=new AgendaFetes();
            Tlog::getInstance()->addDebug($data['id']);
            $agendaModel->setFetesId($data['fetes_id']);
            $agendaModel->setTitle($data['title']);
            $agendaModel->setDepartement($data['department']);
            $agendaModel->setVille($data['city']);
            $agendaModel->setDebut($data['begin']);
            $agendaModel->setFin($data['end']);
            $agendaModel->setLien($data['url']); 
            //$agendaModel->setPosition($maxpos + 1);
            $agendaModel->Save();
        } 
        catch (FormValidationException $e) {
            $error_message = $this->createStandardFormValidationErrorMessage($e);
        } 

        $error_message = null;
        $resp = array(
            "error" =>  0,
            "message" => ""
        );

       return $this->redirectToConfigurationPage();
   }

    public function addAction()
    {

        return($this->render('module_add'));
    }
    public function listAction()
    {

        return($this->render('module_configuration'));
    }
 
    public function updateAction()
    {
       $form = $this->createForm('fetes.update.form');
       return($this->render('module_update'));
      // $form = $this->createForm('fetes.update.form');
       
    	// return($this->render('module_update'));
    } 

    public function deleteAction(){
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ['hookfete'], AccessManager::DELETE)) {
            Tlog::getInstance()->addError("delete : response different de null");
            return $response;
        }
        
        $feteId= $this->getRequest()->request->get('fete_id');
        Tlog::getInstance()->addDebug("delete : ".$feteId);
        if ($feteId != "") {
            $fete = AgendaFetesQuery::create()->findPk($feteId);

            if (null !== $fete) {
                $fete->delete();
            }
        }
        return $this->redirectToConfigurationPage();
    }
     protected function redirectToConfigurationPage()
    {
        return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/HookFetes'));
    }


}
