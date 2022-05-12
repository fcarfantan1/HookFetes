<?php

namespace HookFetes\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;


/**
 * Class HookFetesCreationForm
 * @package HookFetes\Form
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class HookFetesCreationForm extends BaseForm {

    protected function buildForm($change_mode = false)
    {
        

        $form = $this->formBuilder;
  

        $definitions = array(
            
            array(
                "id" => "title",
                "label" => Translator::getInstance()->trans("title", array(), 'hookfetes.bo.default'),
                "type" => "text"
            ),
            array(
                "id" => "department",
                "label" => Translator::getInstance()->trans("department", array(), 'hookfetes.bo.default'),
                "type" => "text"
            ),
            array(
                "id" => "city",
                "label" => Translator::getInstance()->trans("city", array(), 'hookfetes.bo.default'),
                "type" => "text"
            ),
            array(
                "id" => "begin",
                "label" => Translator::getInstance()->trans("begin", array(), 'hookfetes.bo.default'),
                "type" => "text"
            ),
            array(
                "id" => "end",
                "label" => Translator::getInstance()->trans("end", array(), 'hookfetes.bo.default'),
                "type" => "text"
            ),
            array(
                "id" => "url",
                "label" => Translator::getInstance()->trans("URL", array(), 'hookfetes.bo.default'),
                "type" => "text"
            )
        );
        foreach ($definitions as $field){
            $form->add(
                $field["id"],
                $field["type"],
                array(
                    'label' => $field["label"],
                    'label_attr' => array(
                        'for' => $field["id"]
                    ),
                )
            );
        }



}


    /**
     * @return string the name of you form. This name must be unique
     */
    public function getName()
    {
        return "hookfetes_creation_form";
    }


} 
