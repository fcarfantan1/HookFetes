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

namespace HookFetes\Events;

/**
 * Class HookFetesDeleteEvent
 * @package HookFetes\Events
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class HookFetesDeleteEvent extends HookFetesEvent
{
    /** @var int */
    protected $fete_id;

   
    public function __construct($fete_id)
    {
        $this->setFeteId($fete_id);
    }

    public function getFeteId()
    {
        return $this->fete_id;
    }

    public function setFeteId($fete_id)
    {
        $this->fete_id = $fete_id;

        return $this;
    }
}
