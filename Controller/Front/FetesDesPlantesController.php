<?php
namespace HookFetes\Controller\Front;

use Thelia\log\Tlog;

use Thelia\Controller\Front\BaseFrontController;

/**
*
* Gestion en ajax de la liste de produits
*
* @author Nom Prénom <e-mail>
*/

class FetesDesPlantesController extends BaseFrontController
{

    public function getFetesList()
    {
       $lang=$this->getRequest()->getSession()->getLang()->getLocale();
       return $this->render('FetesDesPlantes',['LANG'=>$lang]);
   }

}
