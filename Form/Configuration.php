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

namespace HookFetes\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;
use HookFetes\Model\AgendaFetesQuery;

/**
 * Class Configuration
 * @package HookFetes\Form
 * @author Julien Chanséaume <jchanseaume@openstudio.fr>
 */
class Configuration extends BaseForm {

    protected function buildForm()
    {
        $form = $this->formBuilder;
  /**      $fetes = AgendaFetesQuery::create()->orderByDebut()->find();
        foreach($fetes as $fete){
            $id=$fete->getFetesId();
        } **/
        $this->formBuilder
        ->add("title", "text", array("label" => "Titre"))
        ->add("code_postal", "text", array("label" => "Code Postal"))
        ->add("ville", "text", array( "label" => "Commune"))
        ->add("debut", "date",array("label" => "Date de début"))
        ->add("fin", "date", array("label" => "Date de fin"));
}


    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "hookfetes_configuration_form";
    }


} 
