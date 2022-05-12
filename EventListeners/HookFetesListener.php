<?php


namespace HookFetes\EventListeners;

use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class HookFetesListener
 * @package HookFetes
 * @author FrançoisCarfantan <f.carfantan@orange.fr>
 */
class HookFetesListener implements EventSubscriberInterface
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            HookFetesEvents::UPDATE_POSITION => 'update_position';
        ];
    }
}
