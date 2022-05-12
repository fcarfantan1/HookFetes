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

use Propel\Runtime\Util\PropelDateTime;

/**
 * Class HookFetesCreateEvent
 * @author François Carfantan <f.carfantan@orange.fr>
 * @package HookFetes\Events
 */
class HookFetesCreateEvent extends HookFetesEvent
{
    protected $title;
    protected $description;
    protected $departement;
    protected $ville;
    protected $lien;
    protected $debut;
    protected $fin;
    
    public function __construct()
    {
        parent::__construct();
    }


    public function getTitle()
    {

        return $this->title;
    }

    /**
     * Get the [description] column value.
     *
     * @return   string
     */
    public function getDescription()
    {

        return $this->description;
    }

    public function getDepartement()
    {

        return $this->departement;
    }

    
    public function getVille()
    {

        return $this->ville;
    }

    
    public function getLien()
    {

        return $this->lien;
    }

    
    public function getDebut($format = NULL)
    {
        if ($format === null) {
            return $this->debut;
        } else {
            return $this->debut instanceof \DateTime ? $this->debut->format($format) : null;
        }
    }

    
    public function getFin($format = NULL)
    {
        if ($format === null) {
            return $this->fin;
        } else {
            return $this->fin instanceof \DateTime ? $this->fin->format($format) : null;
        }
    }


    public function getPosition()
    {

        return $this->position;
    }

    

    public function setTitle($v)
    {

        $this->title = $v;
    } 
    public function setDescription($v)
    {

        $this->description = $v;


    } 
    public function setDepartement($v)
    {
        $this->departement = $v;

    } 
    public function setVille($v)
    {

        $this->ville = $v;


    } 
    public function setLien($v)
    {

        $this->lien = $v;


    } 

 public function setEndDate($endDate)
    {
        $this->endDate = PropelDateTime::newInstance($endDate, null, '\DateTime');

        return $this;
    }

    public function setDebut($v)
    {
        $this->debut = PropelDateTime::newInstance($v, null, '\DateTime');
        return $this;
    }
       

    public function setFin($v)
    {
        $this->fin = PropelDateTime::newInstance($v, null, '\DateTime');
    }
       
}
