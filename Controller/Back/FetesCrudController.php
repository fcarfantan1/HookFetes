<?php
namespace HookFetes\Controller\Back;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Thelia\Log\Tlog;

use Thelia\Tools\URL;

use Thelia\Core\Event\UpdatePositionEvent;

use HookFetes\Model\AgendaFetesQuery;

use Thelia\Controller\Admin\AbstractCrudController;

use HookFetes\Events\HookFetesEvents;
use HookFetes\Events\HookFetesCreateEvent;
use HookFetes\Events\HookFetesUpdateEvent;
use HookFetes\Events\HookFetesDeleteEvent;


/**
 * Class Configuration
 * @package HookFetes\Controller
 * @author Francois Carfantan <f.carfantan@orange.fr>
 */
class FetesCrudController extends AbstractCrudController
{

    protected $changePositionEventIdentifier;
	 public function __construct()
        {
            parent::__construct(
            'agendafetes',
            'manual',
            'order',
            'admin.configuration.fetes',
            HookFetesEvents::FETES_CREATE,
            HookFetesEvents::FETES_UPDATE,
            HookFetesEvents::FETES_DELETE,
            null, // No visibility toggle
            HookFetesEvents::FETES_UPDATE_POSITION
        );
            $this->setCurrentRouter("router.HookFetes");
  //          $this->changePositionEventIdentifier=HookFetesEvents::FETES_UPDATE_POSITION;
        
    }
     protected function getCreationForm()
    {
        return $this->createForm('fetes.creation.form');
    }

    protected function getUpdateForm()
    {
         Tlog::getInstance()->addDebug("FCA");
        return $this->createForm('fetes.modification.form');
    }

    protected function getCreationEvent($formData)
    {
        Tlog::getInstance()->addDebug("FCA");
        $createEvent = new HookFetesCreateEvent();
        $createEvent->setTitle($formData['title']);
         $createEvent->setDepartement($formData['department']);
         $createEvent->setVille($formData['city']);
         $createEvent->setDebut($formData['begin']);
         $createEvent->setFin($formData['end']);
         $createEvent->setLien($formData['url']);
        return $createEvent;
    }

    protected function getUpdateEvent($formData)
    {
        $changeEvent = new HookFetesUpdateEvent($formData['id']);
        
        
        // Create and dispatch the change event
        $changeEvent
           ->setTitle($formData['title'])
            ->setDepartement($formData['department'])
            ->setVille($formData['city'])
            ->setDebut($formData['begin'])
            ->setFin($formData['end'])
            ->setLien($formData['url']) ;
            Tlog::getInstance()->addDebug($changeEvent->getVille());
        return $changeEvent;
    }

    /**
     * Process the features values (fix it in future version to integrate it in the feature form as a collection)
     *
     * @see \Thelia\Controller\Admin\AbstractCrudController::performAdditionalUpdateAction()
     */
    protected function performAdditionalUpdateAction($updateEvent)
    {
        $attr_values = $this->getRequest()->get('hookfetes_id', null);

        if ($attr_values !== null) {
            foreach ($attr_values as $id => $value) {

                $event = new HookFetesUpdateEvent($id);
                $event
                    ->setTitle($formData['title'])
                    ->setDepartement($formData['departement'])
                    ->setVille($formData['ville'])
                    ->setDebut($formData['debut'])
                    ->setFin($formData['fin'])
                    ->setLien($formData['lien']) ;
                $this->dispatch(HookFetesEvents::FETE_UPDATE, $event);
            }
        }

        return null;
    }
    protected function getDeleteEvent()
    {
        Tlog::getInstance()->addDebug("FCA getDeleteEvent");
        return new HookFetesDeleteEvent($this->getRequest()->get('hookfetes_id'));
    }
     

    protected function eventContainsObject($event)
    {
        return $event->hasHookFetes();
    }

    protected function hydrateObjectForm($object)
    {
        Tlog::getInstance()->addDebug("FCA : ".$object->getFetesId());
        $data = array(
            'id'   => $object->getFetesId(),
            'title'           => $object->getTitle(),
            'department'       => $object->getDepartement(),
            'city'        => $object->getVille(),
            'begin'        => $object->getDebut("Y-m-d"),
            'end'  => $object->getFin("Y-m-d"),
            'url' => $object->getLien()
        );

        // Setup the object form
        return $this->createForm('fetes.modification.form', "form", $data);
    }

    protected function getObjectFromEvent($event)
    {
        return $event->hasHookFetes() ? $event->getHookFetes() : null;
    }

    protected function getExistingObject()
    {
        
        $fete = AgendaFetesQuery::create()->findOneByFetesId($this->getRequest()->query->get('fete_id'));
        return $fete;
    }

    /**
     * @param Feature $object
     * @return string
     */
    protected function getObjectLabel($object)
    {
        return $object->getTitle();
    }

    /**
     * @param Feature $object
     * @return int
     */
    protected function getObjectId($object)
    {
          return $object->getFetesId();
    }

     protected function renderListTemplate($currentOrder)
    {
        Tlog::getInstance()->addDebug("FCA render List Template");
        // Get product order
        $hookfetes_order = $this->getListOrderFromSession('hookfetes', 'hookfetes_order', 'manual');

       return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/HookFetes'));
    }

    protected function renderEditionTemplate()
    {
        Tlog::getInstance()->addDebug("FCA render Edition Template");
        return $this->render(
            'hookfetes-edit',$this->getEditionArguments());
    }


    protected function redirectToEditionTemplate()
    {
        Tlog::getInstance()->addDebug("redirect to edition");
        return $this->generateRedirectFromRoute("hookfetes.back.configuration.update",$this->getEditionArguments()
        );
    }
    protected function createUpdatePositionEvent($positionChangeMode, $positionValue)
    {
         Tlog::getInstance()->addDebug("fete_id : ".$this->getRequest()->get('fete_id'));
        
        return new UpdatePositionEvent(
            $this->getRequest()->get('fete_id', null),
            $positionChangeMode,
            $positionValue
        );
    }
   
    /**
     * Must return a RedirectResponse instance
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToListTemplate(){
         Tlog::getInstance()->addDebug("FCA redirectToListTemplate");
         return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/HookFetes'));
        //   return $this->generateRedirectFromRoute(
        //     'admin.hookfetes.default'
        // );
	}
    protected function getEditionArguments()
    {
        print($this->getRequest()->get('title',0));
        return array(
                'feteid'           => $this->getRequest()->get('fete_id', 0),
                'title'            => $this->getRequest()->get('title', 0),
                'city'             => $this->getRequest()->get('city', 0),
                'department'       => $this->getRequest()->get('department', 0),
                'begin'            => $this->getRequest()->get('begin'),
                'end'              => $this->getRequest()->get('end'),
                'url'              => $this->getRequest()->get('url')
        );
    }
   
   
}