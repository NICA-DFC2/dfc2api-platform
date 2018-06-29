<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Services\Objets\WsDocumEnt;
use App\Utils\Extensions\Document;
use App\Utils\Ligne;

/**
 * Entité qui représente une entête de facture. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_factures_items_get"},
 *          "allInLimit"={"route_name"="api_factures_limit_items_get"}
 *      },
 *     itemOperations={
 *          "edition"={"route_name"="api_factures_edition_item_get"}
 *     }
 * )
 *
 */
class Facture extends Document
{
    private $CodTvaDE = array();
    private $BaseHTDE = array();
    private $BaseTvaDE = array();
    private $BaseTgapDE = array();
    private $BaseParafDE = array();
    private $MontTgapTableDE = array();
    private $MontParafTableDE = array();
    private $MontTvaTableDE = array();
    private $EtatFacDE = null;

    public function setLigne(Ligne $ligne)
    {
        parent::setLignes($ligne);
    }

    /**
     * parseObject
     * Prend un argument $object : hydrate l'objet avec la structure json passée en argument
     */
    public function parseObject(WsDocumEnt $object) {
        if(!is_null($object)) {
            $this->setFamDocDE($object->{'FamDocDE'});
            $this->setIdDE($object->{'IdDE'});
            $this->setIdDocDE($object->{'IdDocDE'});
            $this->setNumDE($object->{'NumDE'});
            $this->setDateDE($object->{'DateDE'});
            $this->setIdSoc($object->{'IdSoc'});
            $this->setEtatDE($object->{'EtatDE'});
            $this->setTypeDE($object->{'TypeDE'});
            $this->setRefDE($object->{'RefDE'});
            $this->setMontTTCDE($object->{'MontTTCDE'});
            $this->setMontHTDE($object->{'MontHTDE'});
            $this->setComDE($object->{'ComDE'});
            $this->setAnnotDE($object->{'AnnotDE'});
            $this->setFlgValidDE($object->{'FlgValidDE'});
            $this->setMotsClesAutoDE($object->{'MotsClesAutoDE'});
            $this->setEchRegDE($object->{'EchRegDE'});
            $this->setFinMoisDE($object->{'FinMoisDE'});
            $this->setDecalRegDE($object->{'DecalRegDE'});
            $this->setJRegDE($object->{'JRegDE'});
            $this->setMRegDE($object->{'MRegDE'});
            $this->setFlgTTCDE($object->{'FlgTTCDE'});
            $this->setRemDE($object->{'RemDE'});
            $this->setTypeTvaDE($object->{'TypeTvaDE'});
            $this->setIdDepCre($object->{'IdDepCre'});
            $this->setIdDepLiv($object->{'IdDepLiv'});
            $this->setCodDepCre($object->{'CodDepCre'});
            $this->setCodDepLiv($object->{'CodDepLiv'});
            $this->setCodPortDE($object->{'CodPortDE'});
            $this->setIdCam($object->{'IdCam'});
            $this->setCodCam($object->{'CodCam'});
            $this->setLibCam($object->{'LibCam'});
            $this->setDateCreDE($object->{'DateCreDE'});
            $this->setHeureCreDE($object->{'HeureCreDE'});
            $this->setDateModDE($object->{'DateModDE'});
            $this->setIdDUCre($object->{'IdDUCre'});
            $this->setIdDUMod($object->{'IdDUMod'});
            $this->setCodTvaDE($object->{'CodTvaDE'});
            $this->setBaseHTDE($object->{'BaseHTDE'});
            $this->setBaseTvaDE($object->{'BaseTvaDE'});
            $this->setBaseTgapDE($object->{'BaseTgapDE'});
            $this->setBaseParafDE($object->{'BaseParafDE'});
            $this->setMontTvaDE($object->{'MontTvaDE'});
            $this->setMontTgapDE($object->{'MontTgapDE'});
            $this->setMontParafDE($object->{'MontParafDE'});
            $this->setMontTgapTableDE($object->{'MontTgapTableDE'});
            $this->setMontParafTableDE($object->{'MontParafTableDE'});
            $this->setMontTvaTableDE($object->{'MontTvaTableDE'});
            $this->setMontHTApRemDE($object->{'MontHTApRemDE'});
            $this->setMontTvaApRemDE($object->{'MontTvaApRemDE'});
            $this->setMontParafApRemDE($object->{'MontParafApRemDE'});
            $this->setMontTTCApRemDE($object->{'MontTTCApRemDE'});
            $this->setMontHTMarDE($object->{'MontHTMarDE'});
            $this->setMontRevReMarDE($object->{'MontRevReMarDE'});
            $this->setMontRevConvMarDE($object->{'MontRevConvMarDE'});
            $this->setMontEcoTaxeDE($object->{'MontEcoTaxeDE'});
            $this->setMontHTAvecPortDE($object->{'MontHTAvecPortDE'});
            $this->setMontRevReDE($object->{'MontRevReDE'});
            $this->setMontRevConvDE($object->{'MontRevConvDE'});
            $this->setTotPoidsDE($object->{'TotPoidsDE'});
            $this->setComLivDE($object->{'ComLivDE'});
            $this->setZoneLivDE($object->{'ZoneLivDE'});
            $this->setFlgTva2DE($object->{'FlgTva2DE'});
            $this->setTotRegDE($object->{'TotRegDE'});
            $this->setMontHTExtDE($object->{'MontHTExtDE'});
            $this->setMontTVAExtDE($object->{'MontTVAExtDE'});
            $this->setMontTTCExtDE($object->{'MontTTCExtDE'});
            $this->setDateRegDE($object->{'DateRegDE'});
            $this->setRSocDE($object->{'RSocDE'});
            $this->setDateHeureEditDE($object->{'DateHeureEditDE'});
            $this->setCodRgpt($object->{'CodRgpt'});
            $this->setHASH($object->{'HASH'});
            $this->setIdCli($object->{'IdCli'});
            $this->setNoCli($object->{'NoCli'});
            $this->setCodCli($object->{'CodCli'});
            $this->setNoComptaCli($object->{'NoComptaCli'});
            $this->setRSocCli($object->{'RSocCli'});
            $this->setRSocLivDE($object->{'RSocLivDE'});
            $this->setAdrLivDE($object->{'AdrLivDE'});
            $this->setCPLivDE($object->{'CPLivDE'});
            $this->setVilleLivDE($object->{'VilleLivDE'});
            $this->setPaysLivDE($object->{'PaysLivDE'});
            $this->setTelLivDE($object->{'TelLivDE'});
            $this->setFaxLivDE($object->{'FaxLivDE'});
            $this->setMailLivDE($object->{'MailLivDE'});
            $this->setRSocFacDE($object->{'RSocFacDE'});
            $this->setAdrFacDE($object->{'AdrFacDE'});
            $this->setCPFacDE($object->{'CPFacDE'});
            $this->setVilleFacDE($object->{'VilleFacDE'});
            $this->setPaysFacDE($object->{'PaysFacDE'});
            $this->setTelFacDE($object->{'TelFacDE'});
            $this->setFaxFacDE($object->{'FaxFacDE'});
            $this->setMailFacDE($object->{'MailFacDE'});
            $this->setIdSalVend($object->{'IdSalVend'});
            $this->setCodSalVend($object->{'CodSalVend'});
            $this->setIdSalRep($object->{'IdSalRep'});
            $this->setCodSalRep($object->{'CodSalRep'});
            $this->setIdCha($object->{'IdCha'});
            $this->setCodCha($object->{'CodCha'});
            $this->setLibCha($object->{'LibCha'});
            $this->setAdrCha($object->{'AdrCha'});
            $this->setCPCha($object->{'CPCha'});
            $this->setVilleCha($object->{'VilleCha'});
            $this->setMontPortDE($object->{'MontPortDE'});
            $this->setDateLivDE($object->{'DateLivDE'});
            $this->setIdTC($object->{'IdTC'});
            $this->setPrisParDE($object->{'PrisParDE'});
            $this->setDateReacDE($object->{'DateReacDE'});
            $this->setFlgPFDE($object->{'FlgPFDE'});
            $this->setCodOrigDE($object->{'CodOrigDE'});
            $this->setDateCloDE($object->{'DateCloDE'});
        }
    }

    /**
     * @return EtatFacture|null
     */
    public function getEtatFacDE()
    {
        return $this->EtatFacDE;
    }

    /**
     * @param EtatFacture|null $EtatFacDE
     */
    public function setEtatFacDE(EtatFacture $EtatFacDE)
    {
        $this->EtatFacDE = $EtatFacDE;
    }

    /**
     * @return array
     */
    public function getCodTvaDE()
    {
        return $this->CodTvaDE;
    }

    /**
     * @param array $CodTvaDE
     */
    public function setCodTvaDE($CodTvaDE)
    {
        $this->CodTvaDE = $CodTvaDE;
    }

    /**
     * @return array
     */
    public function getBaseHTDE()
    {
        return $this->BaseHTDE;
    }

    /**
     * @param array $BaseHTDE
     */
    public function setBaseHTDE($BaseHTDE)
    {
        $this->BaseHTDE = $BaseHTDE;
    }

    /**
     * @return array
     */
    public function getBaseTvaDE()
    {
        return $this->BaseTvaDE;
    }

    /**
     * @param array $BaseTvaDE
     */
    public function setBaseTvaDE($BaseTvaDE)
    {
        $this->BaseTvaDE = $BaseTvaDE;
    }

    /**
     * @return array
     */
    public function getBaseTgapDE()
    {
        return $this->BaseTgapDE;
    }

    /**
     * @param array $BaseTgapDE
     */
    public function setBaseTgapDE($BaseTgapDE)
    {
        $this->BaseTgapDE = $BaseTgapDE;
    }

    /**
     * @return array
     */
    public function getBaseParafDE()
    {
        return $this->BaseParafDE;
    }

    /**
     * @param array $BaseParafDE
     */
    public function setBaseParafDE($BaseParafDE)
    {
        $this->BaseParafDE = $BaseParafDE;
    }

    /**
     * @return array
     */
    public function getMontTgapTableDE()
    {
        return $this->MontTgapTableDE;
    }

    /**
     * @param array $MontTgapTableDE
     */
    public function setMontTgapTableDE($MontTgapTableDE)
    {
        $this->MontTgapTableDE = $MontTgapTableDE;
    }

    /**
     * @return array
     */
    public function getMontParafTableDE()
    {
        return $this->MontParafTableDE;
    }

    /**
     * @param array $MontParafTableDE
     */
    public function setMontParafTableDE($MontParafTableDE)
    {
        $this->MontParafTableDE = $MontParafTableDE;
    }

    /**
     * @return array
     */
    public function getMontTvaTableDE()
    {
        return $this->MontTvaTableDE;
    }

    /**
     * @param array $MontTvaTableDE
     */
    public function setMontTvaTableDE($MontTvaTableDE)
    {
        $this->MontTvaTableDE = $MontTvaTableDE;
    }


}