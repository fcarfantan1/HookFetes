<?php

namespace HookFetes\Model;

use HookFetes\Model\Base\AgendaFetes as BaseAgendaFetes;

use Thelia\Model\Tools\ModelEventDispatcherTrait;
use Thelia\Model\Tools\PositionManagementTrait;

class AgendaFetes extends BaseAgendaFetes
{
	use ModelEventDispatcherTrait;
	use PositionManagementTrait;
}
