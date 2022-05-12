<?php

namespace HookFetes\Form;

use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;


/**
 * Class FetesAddForm
 * @package HookFetes\Form
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class FetesAddForm extends BaseForm {

    protected function buildForm()
    {
        

        $form = $this->formBuilder;
  

        $definitions = array(
            array(
                "id" => "id",
                "label" => Translator::getInstance()->trans("Id", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "title",
                "label" => Translator::getInstance()->trans("Title", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "department",
                "label" => Translator::getInstance()->trans("Department", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "city",
                "label" => Translator::getInstance()->trans("City", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "begin",
                "label" => Translator::getInstance()->trans("Begin", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "end",
                "label" => Translator::getInstance()->trans("End", array(), 'hookfetes'),
                "type" => "text"
            ),
            array(
                "id" => "url",
                "label" => Translator::getInstance()->trans("URL", array(), 'hookfetes'),
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
        return "hookfetes_update";
    }


} 
