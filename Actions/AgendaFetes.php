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

namespace HookFetes\Actions;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use HookFetes\Model\AgendaFetesQuery;
use HookFetes\Model\AgendaFetes as AgendaFetesModel;
use HookFetes\Events\HookFetesEvents;
use HookFetes\Events\HookFetesDeleteEvent;
use HookFetes\Events\HookFetesUpdateEvent;
use HookFetes\Events\HookFetesCreateEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Core\Event\UpdatePositionEvent;
use Thelia\Log\Tlog;
use Thelia\Tools\URL;
use Thelia\Model\TemplateQuery;
use Thelia\Action\BaseAction;

class AgendaFetes extends BaseAction implements EventSubscriberInterface
{
    
    public function create(HookFetesCreateEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $fete = new AgendaFetesModel();
        Tlog::getInstance()->addInfo(" createaction ");
        $maxpos = AgendaFetesQuery::create()
            ->select('max_pos') 
            ->addAsColumn('max_pos', 'MAX(position)')
            ->findOne();
        Tlog::getInstance()->addInfo("position maximale : ".$maxpos);
        $fete
            ->setTitle($event->getTitle())
            ->setDepartement($event->getDepartement())
            ->setVille($event->getVille())
            ->setDebut($event->getDebut())
            ->setFin($event->getFin())
            ->setLien($event->getLien())
            ->setPosition($maxpos + 1)
            ->setDispatcher($dispatcher)
            ->save();
            $event->setHookFetes($fete);
     //       return $this->redirectToConfigurationPage();
    }

    /**
     * Change a product feature
     *
     * @param \Thelia\Core\Event\Feature\HookFetesUpdateEvent $event
     * @param $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function update(HookFetesUpdateEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        
        if (null !== $fete = AgendaFetesQuery::create()->findPk($event->getFeteId())) {
            Tlog::getInstance()->addDebug("FCA : ".$event->getVille());
             $fete
            ->setTitle($event->getTitle())
            ->setDepartement($event->getDepartement())
            ->setVille($event->getVille())
            ->setDebut($event->getDebut())
            ->setFin($event->getFin())
            ->setLien($event->getLien())
            ->setDispatcher($dispatcher)
            ->save();
            $event->setHookFetes($fete);
        }
    }

    /**
     * Delete a product feature entry
     *
     * @param HookFetesDeleteEvent $event
     * @param $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function delete(HookFetesDeleteEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        if (null !== ($fete = AgendaFetesQuery::create()->findPk($event->getFeteId()))) {
            $fetes_suivantes = AgendaFetesQuery::create()
                ->filterByPosition(array('min' => $fete->getPosition()+1))
                ->find();
            
            $fete
                ->setDispatcher($dispatcher)
                ->delete();
                Tlog::getInstance()->addDebug("FCA : update");
                foreach($fetes_suivantes as $fete_suivante){
                    $fete_suivante->setPosition($fete_suivante->getPosition()-1);
                    $fete_suivante->save();
                }
          
            $event->setHookFetes($fete);
        }
       return $this->redirectToConfigurationPage();
    }

    /**
     * Changes position, selecting absolute ou relative change.
     *
     * @param UpdatePositionEvent $event
     * @param $eventName
     * @param EventDispatcherInterface $dispatcher
     */
    public function updatePosition(UpdatePositionEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
       
        Tlog::getInstance()->addDebug("FCA : Action : UpdatePosition : HookFetes");
        $this->genericUpdatePosition(AgendaFetesQuery::create(), $event, $dispatcher);
    }

     public function genericUpdatePosition(ModelCriteria $query, UpdatePositionEvent $event, EventDispatcherInterface $dispatcher = null)
    {
        Tlog::getInstance()->addDebug("FCA : Action : ".$event->getObjectId());
        if (null !== $object = $query->findPk($event->getObjectId())) {
        
            if (!isset(class_uses($object)['Thelia\Model\Tools\PositionManagementTrait'])) {
                throw new \InvalidArgumentException("Your model does not implement the PositionManagementTrait trait");
            }
            
            $object->setDispatcher($dispatcher !== null ? $dispatcher : $event->getDispatcher());

            $mode = $event->getMode();
 
            if ($mode == UpdatePositionEvent::POSITION_ABSOLUTE) {
                $object->changeAbsolutePosition($event->getPosition());
            } elseif ($mode == UpdatePositionEvent::POSITION_UP) {
                $object->movePositionUp();
            } elseif ($mode == UpdatePositionEvent::POSITION_DOWN) {
                $object->movePositionDown();
            }
        }
    }
   

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            HookFetesEvents::FETES_UPDATE_POSITION => array("updatePosition", 128),
            HookFetesEvents::FETES_CREATE => array("create",128),
            HookFetesEvents::FETES_DELETE => array("delete",128),
            HookFetesEvents::FETES_UPDATE => array("update",128)
        );
    }
    protected function redirectToConfigurationPage()
    {
        return RedirectResponse::create(URL::getInstance()->absoluteUrl('/admin/module/HookFetes'));
    }
}
