<?php


namespace HookFetes\Form;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Thelia\log\Tlog;

/*
 * Class HookFetesModificationForm
 * @package HookFetes\Form
 * @author  François Carfantan <f.carfantan@orange.fr>
 *
 */
class HookFetesModificationForm extends HookFetesCreationForm
{
  protected function buildForm($change_mode = false)
    {
      var_dump($this->getRequest()->query->get("fete_id"));
        parent::buildForm(true);
        Tlog::getInstance()->addDebug("FCA : HookFetesModificationForm2");

         $this->formBuilder
            ->add("id", "hidden", array(
                    "constraints" => array(new GreaterThan(array('value' => 0))),
            ));
       
    }
    
    public function getName()
    {
        return 'hookfetes_modification_form';
    }
}

