<?php

namespace App\Services\Json;

use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTParam;
use App\Services\Objets\CritParam;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Objets\WsDepot;
use App\Services\Objets\WsDocumEnt;
use App\Services\Objets\WsDocumLig;
use App\Services\Objets\WsEdition;
use App\Services\Objets\WsFacCliAtt;
use App\Services\Objets\WsLibelle;
use App\Services\Objets\WsStock;
use App\Services\Objets\WsClient;
use App\Services\Objets\WsArticle;
use App\Services\Parameters\WsTableNamesRetour;
use Unirest\Response;

class ResponseDecode
{
    private $response;

    /**
     * Constructeur
     * @param Response $response : réponse de l'appel à décoder
     */
    public function __construct($response)
    {
        $this->setResponse($response);
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }


    /**
     * Decode le paramètre ParamRetour de la réponse
     * contient des informations pour exécuter un autre appel
     * @return TTParam|Notif|null
     */
    public function decodeParamRetour() {
        if(isset($this->getResponse()->body)) {
            if(isset($this->getResponse()->body->response->pojDSParamRetour)) {

                if(!is_object($this->getResponse()->body->response->pojDSParamRetour)) {
                    $pojDSParamRetour= json_decode($this->getResponse()->body->response->pojDSParamRetour, false);
                }
                else {
                    $pojDSParamRetour = $this->getResponse()->body->response->pojDSParamRetour;
                }

                if(!is_object($pojDSParamRetour->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSParamRetour->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSParamRetour->ProDataSet;
                }

                if(isset($ProDataSet->ttParam)) {
                    $ttParam = new TTParam();
                    foreach ($ProDataSet->ttParam as $item){
                        $critParam = new CritParam($item->{'NomPar'}, $item->{'ValPar'}, $item->{'IndPar'}, $item->{'FamPar'});
                        $ttParam->addItem($critParam);
                    }
                    return $ttParam;
                }
                else{
                    return $this->decodeNotif(__FUNCTION__);
                }
            }
        }
        return null;
    }

    /**
     * Decode le paramètre CntxClient de la réponse
     * contient le contexte de connexion de l'utilisateur connecté de type Admin
     * @return CntxAdmin|Notif|null
     */
    public function decodeCntxAdmin() {
        if(isset($this->getResponse()->body)) {
            if(isset($this->getResponse()->body->response->pojDSCntxClient)) {

                if(!is_object($this->getResponse()->body->response->pojDSCntxClient)) {
                    $pojDSCntxClient= json_decode($this->getResponse()->body->response->pojDSCntxClient, false);
                }
                else {
                    $pojDSCntxClient = $this->getResponse()->body->response->pojDSCntxClient;
                }

                if(!is_object($pojDSCntxClient->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSCntxClient->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSCntxClient->ProDataSet;
                }

                if(isset($ProDataSet->ttParam)) {
                    $ttparam = $ProDataSet->ttParam[0];
                    $CntxAdmin = new CntxAdmin(
                        $ttparam->{'IdCais'},
                        $ttparam->{'IdDep'},
                        $ttparam->{'IdentAppliCli'},
                        $ttparam->{'IdSal'},
                        $ttparam->{'IdSession'},
                        $ttparam->{'IdSoc'},
                        $ttparam->{'IdU'},
                        $ttparam->{'Valid'}
                    );
                    return $CntxAdmin;
                }
                else {
                    return $this->decodeNotif(__FUNCTION__);
                }
            }
        }
        return null;
    }

    /**
     * Decode le paramètre Notifi de la réponse
     * contient le ou les messages d'erreurs
     * @param $call_method : function qui entraine l'erreur
     * @return Notif|null
     */
    public function decodeNotif($call_method) {
        if(isset($this->getResponse()->body)) {
            if(isset($this->getResponse()->body->response->pojDSNotif)) {

                if(!is_object($this->getResponse()->body->response->pojDSNotif)) {
                    $pojDSNotif = json_decode($this->getResponse()->body->response->pojDSNotif, false);
                }
                else {
                    $pojDSNotif = $this->getResponse()->body->response->pojDSNotif;
                }

                if(!is_object($pojDSNotif->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSNotif->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSNotif->ProDataSet;
                }

                if(isset($ProDataSet->ttParam)) {

                    if(count($ProDataSet->ttParam) > 0) {
                        $tt = $ProDataSet->ttParam;
                        $texte = '';
                        foreach ($tt as $param) {
                            $texte .= $param->{'Texte'} . '. ';
                        }

                        return new Notif(
                                        $tt[0]->{'Metier'},
                                        $texte,
                                        $tt[0]->{'Titre'},
                                        $tt[0]->{'Type'},
                                        $call_method
                                    );
                    }
                }
            }
        }
        return null;
    }

    /**
     * Decode le paramètre Retour
     * @return TTRetour|Notif|null
     */
    public function decodeRetour($filter_depots = array()) {
        if(isset($this->getResponse()->body)) {

            if(isset($this->getResponse()->body->response->pojDSNotif)) {

                if(!is_object($this->getResponse()->body->response->pojDSNotif)) {
                    $pojDSNotif = json_decode($this->getResponse()->body->response->pojDSNotif, false);
                }
                else {
                    $pojDSNotif = $this->getResponse()->body->response->pojDSNotif;
                }

                if(!is_object($pojDSNotif->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSNotif->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSNotif->ProDataSet;
                }

                if(isset($ProDataSet->ttParam)) {
                    if (count($ProDataSet->ttParam) > 0) {
                        return $this->decodeNotif(__FUNCTION__);
                    }
                }
            }

            if(isset($this->getResponse()->body->response->pojDSRetour)) {
                if(!is_object($this->getResponse()->body->response->pojDSRetour)) {
                    $pojDSRetour= json_decode($this->getResponse()->body->response->pojDSRetour, false);
                }
                else {
                    $pojDSRetour= $this->getResponse()->body->response->pojDSRetour;
                }

                if(!is_object($pojDSRetour->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSRetour->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSRetour->ProDataSet;
                }

                $ttRetour = new TTRetour();


                if(isset($ProDataSet->ttDepot)) {
                    $ttRetour->addTable($this->decodeRetourTTDepot($ProDataSet->ttDepot), WsTableNamesRetour::TABLENAME_TT_DEPOT);
                }
                if(isset($ProDataSet->ttCli)) {
                    $ttRetour->addTable($this->decodeRetourTTCli($ProDataSet->ttCli), WsTableNamesRetour::TABLENAME_TT_CLI);
                }
                if(isset($ProDataSet->ttArtDet)) {
                    $ttRetour->addTable($this->decodeRetourTTArtDet($ProDataSet->ttArtDet), WsTableNamesRetour::TABLENAME_TT_ARTDET);
                }
                if(isset($ProDataSet->ttStock)) {
                    $ttArtDet = $ttRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                    for ($iTTArtDet=0;$iTTArtDet<$ttArtDet->countItems();$iTTArtDet++){
                        $wsArticle = $ttArtDet->getItem($iTTArtDet);
                        $wsArticle->setStocks($this->decodeRetourTTStock($ProDataSet->ttStock, $wsArticle, $filter_depots));
                        $ttArtDet->setItem($iTTArtDet, $wsArticle);
                    }

//                    $article = new WsArticle();
//                    if($ttArtDet->countItems() > 0) {
//                        $article = $ttArtDet->getItem(0);
//                    }
//                    $ttRetour->setTable($this->decodeRetourTTStock($ProDataSet->ttStock, $article, $filter_depots), WsTableNamesRetour::TABLENAME_TT_STOCK);
                }
                if(isset($ProDataSet->ttFacCliAtt)) {
                    $ttRetour->addTable($this->decodeRetourTTFacCliAtt($ProDataSet->ttFacCliAtt), WsTableNamesRetour::TABLENAME_TT_FACCLIATT);
                }
                if(isset($ProDataSet->ttDocumEnt)) {
                    $ttRetour->addTable($this->decodeRetourTTDocumEnt($ProDataSet->ttDocumEnt), WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                }
                if(isset($pojDSRetour->ProDataSet->ttDocumLig)) {
                    $ttRetour->addTable($this->decodeRetourTTDocumLig($ProDataSet->ttDocumLig), WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);
                }
                if(isset($ProDataSet->ttEdition)) {
                    $ttRetour->addTable($this->decodeRetourTTEdition($ProDataSet->ttEdition), WsTableNamesRetour::TABLENAME_TT_EDITION);
                }
                if(isset($ProDataSet->ttStat)) {
                    $ttRetour->addTable($this->decodeRetourTTStat($ProDataSet->ttStat), WsTableNamesRetour::TABLENAME_TT_STAT);
                }
                if(isset($ProDataSet->ttLib)) {
                    $ttRetour->addTable($this->decodeRetourTTLib($ProDataSet->ttLib), WsTableNamesRetour::TABLENAME_TT_LIB);
                }

                return $ttRetour;
            }
        }
        return null;
    }

    /**
     * Decode le paramètre Retour.
     * Retourne le prix net uniquement
     * @return mixed|Notif|null
     */
    public function decodeRetourPrixNet() {
        if(isset($this->getResponse()->body)) {
            if(isset($this->getResponse()->body->response->pojDSRetour)) {

                if(!is_object($this->getResponse()->body->response->pojDSRetour)) {
                    $pojDSRetour = json_decode($this->getResponse()->body->response->pojDSRetour, false);
                }
                else {
                    $pojDSRetour = $this->getResponse()->body->response->pojDSRetour;
                }

                if(!is_object($pojDSRetour->ProDataSet)) {
                    $ProDataSet= json_decode($pojDSRetour->ProDataSet, false);
                }
                else {
                    $ProDataSet= $pojDSRetour->ProDataSet;
                }

                if(isset($ProDataSet->ttArtDet)) {
                    return $this->decodeRetourTTArtDetPrixNet($ProDataSet->ttArtDet);
                }

                return $this->decodeNotif(__FUNCTION__);
            }
        }
        return null;
    }

    /**
     * Decode la collection de clients de la réponse
     * @param $ttCli
     * @return TTParam
     */
    private function decodeRetourTTCli($ttCli){
        $ttReturn = new TTParam();

        foreach ($ttCli as $item){
            $client = new WsClient($item);
            $ttReturn->addItem($client);
        }

        return $ttReturn;
    }

    /**
     * Decode la collection de depots de la réponse
     * @param $ttDepot
     * @return TTParam
     */
    private function decodeRetourTTDepot($ttDepot){
        $ttReturn = new TTParam();
        foreach ($ttDepot as $item){
            $depot = new WsDepot($item);
            $ttReturn->addItem($depot);
        }
        return $ttReturn;
    }

    /**
     * Decode la collection de libellés de la réponse
     * @param $ttLib
     * @return TTParam
     */
    private function decodeRetourTTLib($ttLib){
        $ttReturn = new TTParam();
        foreach ($ttLib as $item){
            $libelle = new WsLibelle($item);
            $ttReturn->addItem($libelle);
        }
        return $ttReturn;
    }

    /**
     * Decode la collection d'articles de la réponse
     * @param $ttArtDet
     * @return TTParam
     */
    private function decodeRetourTTArtDet($ttArtDet){
        $ttReturn = new TTParam();
        foreach ($ttArtDet as $item){
            $article = new WsArticle($item);
            $ttReturn->addItem($article);
        }
        return $ttReturn;
    }

    /**
     * Decode la collection d'articles de la réponse et retourne que le PrixNet du client connecté
     * @param $ttArtDet
     * @return mixed
     */
    private function decodeRetourTTArtDetPrixNet($ttArtDet){
        foreach ($ttArtDet as $item){
            $article = new WsArticle($item);
            return $article->getPrixNet();
        }
        return 0.0;
    }

    /**
     * Decode la collection d'articles avec le stock par dépot de la réponse
     * @param $ttStock
     * @return array
     */
    private function decodeRetourTTStock($ttStock, WsArticle $article_current, $filter_depots){
        $stocks = array();
        foreach ($ttStock as $item){
            $stock = new WsStock($item);

            if(intval($article_current->getIdArt()) === intval($item->{"IdArt"}))
            {
                if(count($filter_depots) > 0) {
                    if (in_array(intval($stock->getIdDep()), $filter_depots)) {
                        array_push($stocks, $stock);
                    }
                }
                else {
                    array_push($stocks, $stock);
                }
            }
        }
        return $stocks;
    }

    /**
     * Decode la collection des factures client en attentes de la réponse
     * @param $ttDocumEnt
     * @return TTParam
     */
    private function decodeRetourTTFacCliAtt($ttFacCliAtt){
        $ttReturn = new TTParam();
        foreach ($ttFacCliAtt as $item){
            $ent = new WsFacCliAtt($item);
            $ttReturn->addItem($ent);
        }

        return $ttReturn;
    }

    /**
     * Decode la collection d'entete de document de la réponse
     * @param $ttDocumEnt
     * @return TTParam
     */
    private function decodeRetourTTDocumEnt($ttDocumEnt){
        $ttReturn = new TTParam();
        foreach ($ttDocumEnt as $item){
            $ent = new WsDocumEnt($item);
            $ttReturn->addItem($ent);
        }
        return $ttReturn;
    }

    /**
     * Decode la collection de lignes de document de la réponse
     * @param $ttDocumLig
     * @return TTParam
     */
    private function decodeRetourTTDocumLig($ttDocumLig){
        $ttReturn = new TTParam();
        foreach ($ttDocumLig as $item){
            $lig = new WsDocumLig($item);
            $ttReturn->addItem($lig);
        }
        return $ttReturn;
    }

    //******
    // NON TERMINEE
    private function decodeRetourTTEdition($ttEdition){
        $ttReturn = new TTParam();
        foreach ($ttEdition as $item){
            $lig = new WsEdition($item);
            $ttReturn->addItem($lig);
        }
        return $ttReturn;
    }

    //******
    // NON TERMINEE
    private function decodeRetourTTStat($ttStat){
        $ttReturn = new TTParam();
/*        foreach ($ttSal as $item){
            $critParam = new CritParam($item->{'NomPar'}, $item->{'ValPar'}, $item->{'IndPar'}, $item->{'FamPar'});
            $ttReturn->addItem($critParam);
        }

        $notif = $this->decodeNotif(__FUNCTION__);
        $ttReturn->setNotif($notif);*/
        return $ttReturn;
    }

}
