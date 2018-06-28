<?php

namespace App\Services\Json;

use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTParam;
use App\Services\Objets\CritParam;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Objets\WsDocumEnt;
use App\Services\Objets\WsDocumLig;
use App\Services\Objets\WsFacCliAtt;
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
        $this->response = $response;
    }

    /**
     * Decode le paramètre ParamRetour de la réponse
     * contient des informations pour exécuter un autre appel
     * @return TTParam|Notif|null
     */
    public function decodeParamRetour() {
        if(isset($this->response->body)) {
            if(isset($this->response->body->response->pojDSParamRetour)) {

                $pojDSParamRetour= json_decode($this->response->body->response->pojDSParamRetour, false);

                if(isset($pojDSParamRetour->ProDataSet->ttParam)) {
                    $ttParam = new TTParam();
                    foreach ($pojDSParamRetour->ProDataSet->ttParam as $item){
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
        if(isset($this->response->body)) {
            if(isset($this->response->body->response->pojDSCntxClient)) {
                $pojDSCntxClient= json_decode($this->response->body->response->pojDSCntxClient, false);

                if(isset($pojDSCntxClient->ProDataSet->ttParam)) {
                    $ttparam = $pojDSCntxClient->ProDataSet->ttParam[0];
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
        if(isset($this->response->body)) {
            if(isset($this->response->body->response->pojDSNotif)) {

                $pojDSNotif= json_decode($this->response->body->response->pojDSNotif, false);

                if(isset($pojDSNotif->ProDataSet->ttParam)) {
                    if(count($pojDSNotif->ProDataSet->ttParam) > 0) {
                        $tt = $pojDSNotif->ProDataSet->ttParam;
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
        if(isset($this->response->body)) {
            if(isset($this->response->body->response->pojDSNotif)) {
                $pojDSNotif= json_decode($this->response->body->response->pojDSNotif, false);

                if(isset($pojDSNotif->ProDataSet->ttParam)) {
                    if (count($pojDSNotif->ProDataSet->ttParam) > 0) {
                        return $this->decodeNotif(__FUNCTION__);
                    }
                }
            }

            if(isset($this->response->body->response->pojDSRetour)) {
                $pojDSRetour= json_decode($this->response->body->response->pojDSRetour, false);

                $ttRetour = new TTRetour();

                if(isset($pojDSRetour->ProDataSet->ttParam)) {
                    $ttRetour->addTable($this->decodeRetourTTParam($pojDSRetour->ProDataSet->ttParam), WsTableNamesRetour::TABLENAME_TT_PARAM);
                }
                if(isset($pojDSRetour->ProDataSet->ttCli)) {
                    $ttRetour->addTable($this->decodeRetourTTCli($pojDSRetour->ProDataSet->ttCli), WsTableNamesRetour::TABLENAME_TT_CLI);
                }
                if(isset($pojDSRetour->ProDataSet->ttArtDet)) {
                    $ttRetour->addTable($this->decodeRetourTTArtDet($pojDSRetour->ProDataSet->ttArtDet), WsTableNamesRetour::TABLENAME_TT_ARTDET);
                }
                if(isset($pojDSRetour->ProDataSet->ttStock)) {
                    $ttArtDet = $ttRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
                    $article = $ttArtDet->getItem(0);
                    $ttRetour->setTable($this->decodeRetourTTStock($pojDSRetour->ProDataSet->ttStock, $article, $filter_depots), WsTableNamesRetour::TABLENAME_TT_STOCK);
                }
                if(isset($pojDSRetour->ProDataSet->ttFacCliAtt)) {
                    $ttRetour->addTable($this->decodeRetourTTFacCliAtt($pojDSRetour->ProDataSet->ttFacCliAtt), WsTableNamesRetour::TABLENAME_TT_FACCLIATT);
                }
                if(isset($pojDSRetour->ProDataSet->ttDocumEnt)) {
                    $ttRetour->addTable($this->decodeRetourTTDocumEnt($pojDSRetour->ProDataSet->ttDocumEnt), WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                }
                if(isset($pojDSRetour->ProDataSet->ttDocumLig)) {
                    $ttRetour->addTable($this->decodeRetourTTDocumLig($pojDSRetour->ProDataSet->ttDocumLig), WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);
                }
                if(isset($pojDSRetour->ProDataSet->ttEdition)) {
                    $ttRetour->addTable($this->decodeRetourTTEdition($pojDSRetour->ProDataSet->ttEdition), WsTableNamesRetour::TABLENAME_TT_EDITION);
                }
                if(isset($pojDSRetour->ProDataSet->ttSal)) {
                    $ttRetour->addTable($this->decodeRetourTTSal($pojDSRetour->ProDataSet->ttSal), WsTableNamesRetour::TABLENAME_TT_SAL);
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
        if(isset($this->response->body)) {
            if(isset($this->response->body->response->pojDSRetour)) {
                $pojDSRetour= json_decode($this->response->body->response->pojDSRetour, false);

                if(isset($pojDSRetour->ProDataSet->ttArtDet)) {
                    return $this->decodeRetourTTArtDetPrixNet($pojDSRetour->ProDataSet->ttArtDet);
                }

                return $this->decodeNotif(__FUNCTION__);
            }
        }
        return null;
    }

    //******
    // NON TERMINEE
    private function decodeRetourTTParam($ttParam){
        $ttReturn = new TTParam();
        dump($ttParam);
/*        foreach ($ttParam as $item){
            $critParam = new CritParam($item->{'NomPar'}, $item->{'ValPar'}, $item->{'IndPar'}, $item->{'FamPar'});
            $ttReturn->addItem($critParam);
        }

        $notif = $this->decodeNotif(__FUNCTION__);
        $ttReturn->setNotif($notif);*/
        return $ttReturn;
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
     * @return WsArticle
     */
    private function decodeRetourTTStock($ttStock, WsArticle $article_current, $filter_depots){
        $ttReturn = new TTParam();
        foreach ($ttStock as $item){
            $stock = new WsStock($item);
            if(count($filter_depots) > 0) {
                if (in_array(intval($stock->getIdDep()), $filter_depots)) {
                    $ttReturn->addItem($stock);
                }
            }
            else {
                $ttReturn->addItem($stock);
            }
        }
        $article_current->setStocks($ttReturn);
        return $article_current;
    }

    //******
    // NON TERMINEE
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
        dump($ttEdition);
/*        foreach ($ttEdition as $item){
            $critParam = new CritParam($item->{'NomPar'}, $item->{'ValPar'}, $item->{'IndPar'}, $item->{'FamPar'});
            $ttReturn->addItem($critParam);
        }

        $notif = $this->decodeNotif(__FUNCTION__);
        $ttReturn->setNotif($notif);*/
        return $ttReturn;
    }

    //******
    // NON TERMINEE
    private function decodeRetourTTSal($ttSal){
        $ttReturn = new TTParam();
        dump($ttSal);
/*        foreach ($ttSal as $item){
            $critParam = new CritParam($item->{'NomPar'}, $item->{'ValPar'}, $item->{'IndPar'}, $item->{'FamPar'});
            $ttReturn->addItem($critParam);
        }

        $notif = $this->decodeNotif(__FUNCTION__);
        $ttReturn->setNotif($notif);*/
        return $ttReturn;
    }

}
