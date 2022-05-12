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
use Thelia\Log\Tlog;
use HookFetes\Model\AgendaFetesQuery;

/**
 * Class Configuration
 * @package HookFetes\Form
 * @author Julien Chanséaume <jchanseaume@openstudio.fr>
 */
class FetesUpdateForm extends BaseForm {

    protected function buildForm()
    {
        

        $form = $this->formBuilder;
        $request=$this->getRequest();

        $fete_id=$request->query->get("fete_id");
        
        Tlog::getInstance()->addDebug("FetesUpdateForm : buildForm".$fete_id);
        $fete_query=AgendaFetesQuery::create();
        $fete=$fete_query->findPk(intval($fete_id));
        if(is_null($fete)){
            Tlog::getInstance()->addError("fete est null");
        }
        Tlog::getInstance()->addDebug("FetesUpdateForm : buildForm".$fete_id);
        $definitions = array(
             array(
                "id" => "id",
                "label" => "id",
                "type" => "text",
                "data" => $fete->getFetesId()
            ),
            array(
                "id" => "title",
                "label" => Translator::getInstance()->trans("title", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getTitle()
            ),
            array(
                "id" => "department",
                "label" => Translator::getInstance()->trans("Department", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getDepartement()
            ),
            array(
                "id" => "city",
                "label" => Translator::getInstance()->trans("City", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getVille()
            ),
            array(
                "id" => "begin",
                "label" => Translator::getInstance()->trans("Begin", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getDebut()->format('Y-m-d')
            ));
        if(!is_null($fete->getFin())){
            array_push($definitions,(
              array(
                "id" => "end",
                "label" => Translator::getInstance()->trans("End", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getFin()->format('Y-m-d')
            )));
        }
        else{
            array_push($definitions,(
              array(
                "id" => "end",
                "label" => Translator::getInstance()->trans("End", array(), 'hookfetes'),
                "type" => "text",
                "data" => ""
            )));

        }

        array_push($definitions,(
              array(
                "id" => "url",
                "label" => Translator::getInstance()->trans("URL", array(), 'hookfetes'),
                "type" => "text",
                "data" => $fete->getLien()
            )));
          
            foreach ($definitions as $field){
                $form->add(
                $field["id"],
                $field["type"],
                array(
                    'data' => $field["data"],
                    'label' => $field["label"],
                    'label_attr' => array(
                        'for' => $field["id"]
                    ),
                )
            );
        }
        
        Tlog::getInstance()->addDebug('FetesUpdateForm : fin');



}


    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "hookfetes_update";
    }


} 
