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

use Thelia\Core\Event\ActionEvent;
use HookFetes\Model\AgendaFetes;

class HookFetesEvent extends ActionEvent
{
    protected $fete = null;

    public function __construct(AgendaFetes $fete = null)
    {
        $this->fete = $fete;
    }

    public function hasHookFetes()
    {
        return ! is_null($this->fete);
    }

    public function getHookFetes()
    {
        return $this->fete;
    }

    public function setHookFetes($fete)
    {
        $this->fete = $fete;

        return $this;
    }
}
