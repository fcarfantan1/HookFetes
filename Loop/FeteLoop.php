<?php
namespace HookFetes\Loop;

use HookFetes\Model\AgendaFetesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\log\Tlog;

/**
 * Class FeteLoop
 * @author François Carfantan <f.carfantan@orange.fr>
 * @package HookFetes\Loop
 */
class FeteLoop extends BaseLoop implements PropelSearchLoopInterface {
		 public function buildModelCriteria()
		{
            
			$search = AgendaFetesQuery::create();
            $search->orderByPosition($order = Criteria::ASC);

			return $search;

		}
		public function parseResults(LoopResult $loopResult)
		{
            //var_dump($loopResult->getResultDataCollection());
            Tlog::getInstance()->addDebug($this->getLang());
			foreach ($loopResult->getResultDataCollection() as $fete) {

         		$loopResultRow = new LoopResultRow();
                $loopResultRow->set("ID",$fete->getFetesId());
         		$loopResultRow->set("TITLE", $fete->getTitle());
         		$loopResultRow->set("VILLE", $fete->getVille());
                $loopResultRow->set("LIEN", $fete->getLien());
                $loopResultRow->set("DEPARTEMENT", $fete->getDepartement());
                $loopResultRow->set("DEBUT", $this->getDebutString($fete->getDebut()));
                $loopResultRow->set("FIN", $this->getFinString($fete->getFin()));
         		$loopResultRow->set("DEBUTFIN",$this->getDebutFinString($fete->getDebut(),$fete->getFin()));
                $loopResultRow->set("URL",$fete->getLien());
                $loopResultRow->set("POSITION",$fete->getPosition());
                $loopResult->addRow($loopResultRow);
     }

     return $loopResult;
		}
        public function getArgDefinitions()
        {
            return new ArgumentCollection(
                Argument::createAnyTypeArgument("lang", "fr_FR")
            );
        }
   
    public function getDebutString($debut){
        setlocale(LC_TIME,$this->getLang());
        $strDebut=$debut->format("m/d/Y");
        $dtmDebut=strtotime($strDebut);
        return strftime("%d/%m/%G",$dtmDebut);
    }
    public function getFinString($fin){
        setlocale(LC_TIME,$this->getLang());
        if(is_null($fin)){
            return "";
        }
        $strFin=$fin->format("m/d/Y");
        $dtmFin=strtotime($strFin);
        return strftime("%d/%m/%G",$dtmFin);
    }
    
    public function getDebutFinString($debut,$fin){
        setlocale(LC_TIME,$this->getLang());
        $debutFinString="";
        $strDebut=$debut->format("m/d/Y");
        $dtmDebut=strtotime($strDebut);
        if($this->getLang()=="en_US"){
            $prefix_seul="";
            $prefix="from";
            $suffix="to";
        }
        else{
            $prefix_seul="le";
            $prefix="du";
            $suffix="au";
        }
           
        if(is_null($fin) || $debut==$fin ){
                $debutFinString=strftime("$prefix_seul %d %B %G",$dtmDebut);
        }
        else{
            $strFin=$fin->format("m/d/Y");
            $dtmFin=strtotime($strFin);
            $moisDebut=strftime("%B",$dtmDebut);
            $moisFin=strftime("%B",$dtmFin);
            Tlog::getInstance()->addDebug($this->getLang());
                $debutFinString=strftime("$prefix %d ",$dtmDebut);
            
            if($moisDebut==$moisFin){
                $debutFinString=$debutFinString.strftime("$suffix %d %B %G",$dtmFin);
            }
            else{
                $anneeDebut=strftime("%G",$dtmDebut);
                $anneeFin=strftime("%G",$dtmFin);
                $debutFinString=$debutFinString.$moisDebut." ";
                if($anneeDebut!=$anneeFin){
                    $debutFinString=$debutFinString.strftime("%G",$dtmFin);
                }
                $debutFinString=$debutFinString.strftime(" $suffix %d %B %G",$dtmFin);
            }
        }
        return $debutFinString;
    }

}


