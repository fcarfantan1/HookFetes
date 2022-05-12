<?php

namespace HookFetes\Events;
use Propel\Runtime\Util\PropelDateTime;
use Thelia\Log\Tlog;

/**
 * Class HookFetesUpdateEvent
 * @package HookFetes\Events
 * @author François Carfantan <f.carfantan@orange.fr>
 */
class HookFetesUpdateEvent extends HookFetesEvent
{
protected $title;
    protected $description;
    protected $departement;
    protected $ville;
    protected $lien;
    protected $debut;
    protected $fin;
    protected $feteId;
    
    public function __construct($fete_id)
    {
        Tlog::getInstance()->addDebug("FCA : ".$fete_id);
        parent::__construct();
        $this->feteId=$fete_id;
    }

    public function setFeteId($f)
    {
        $this->feteId=$f;
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

    public function getFeteId(){
        return $this->feteId;
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
        return $this;
    } 
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
        }


        return $this;
    } 
    public function setDepartement($v)
    {
        
        $this->departement = $v;
        return $this;
    } 
    public function setVille($v)
    {
            $this->ville = (string) $v;
            return $this;
    } 
    public function setLien($v)
    {
            $this->lien = $v;
            return $this;
    } 
    public function setDebut($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->debut !== null || $dt !== null) {
            if ($dt !== $this->debut) {
                $this->debut = $dt;
            }
        } // if either are not null


        return $this;
    } 
    public function setFin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->fin !== null || $dt !== null) {
            if ($dt !== $this->fin) {
                $this->fin = $dt;
            }
        } // if either are not null


        return $this;
    } 
}