<?php
namespace HookFetes\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;


/**
 * Class Front
 * @package Test\Hook
 * @author Julien Chanséaume <jchanseaume@openstudio.fr>
 */
class FrontHook extends BaseHook {

    public function onMainNavbarPrimary(HookRenderEvent $event)
    {
       $html='<li><a href="';
       $html=$html.'hook-fetes-des-plantes';
       $html=$html.'>{intl  d="hookfetes.fo.spiced" l="Plant Fairs"}</a></li>';
       //$html=$html.'">Fêtes des plantes</a></li>';
       $event->add($html);
    }

    

}
?>