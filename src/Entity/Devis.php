<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use App\Services\Objets\WsDocumEnt;
use App\Utils\Extensions\Document;

/**
 * Entité qui représente une entête de devis. Certain champs sont hydratés par un appel aux services web GIMEL.
 *
 * @ApiResource(
 *      collectionOperations={
 *          "all"={"route_name"="api_devis_items_get"}
 *      },
 *     itemOperations={
 *          "edition"={"route_name"="api_devis_edition_item_get"}
 *     }
 * )
 */
class Devis extends Document
{
    private $DateRelDE = null;
    private $IdSalRel = null;
    private $NatDE = null;
    private $DateRealDE = null;

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
            $this->setMontTvaDE($object->{'MontTvaDE'});
            $this->setMontTgapDE($object->{'MontTgapDE'});
            $this->setMontParafDE($object->{'MontParafDE'});
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
            $this->setDateRelDE($object->{'DateRelDE'});
            $this->setIdSalRel($object->{'IdSalRel'});
            $this->setNatDE($object->{'NatDE'});
            $this->setDateRealDE($object->{'DateRealDE'});
        }
    }


    /**
     * @return null
     */
    public function getDateRelDE()
    {
        return $this->DateRelDE;
    }

    /**
     * @param null $DateRelDE
     */
    public function setDateRelDE($DateRelDE)
    {
        $this->DateRelDE = $DateRelDE;
    }

    /**
     * @return null
     */
    public function getIdSalRel()
    {
        return $this->IdSalRel;
    }

    /**
     * @param null $IdSalRel
     */
    public function setIdSalRel($IdSalRel)
    {
        $this->IdSalRel = $IdSalRel;
    }

    /**
     * @return null
     */
    public function getNatDE()
    {
        return $this->NatDE;
    }

    /**
     * @param null $NatDE
     */
    public function setNatDE($NatDE)
    {
        $this->NatDE = $NatDE;
    }

    /**
     * @return null
     */
    public function getDateRealDE()
    {
        return $this->DateRealDE;
    }

    /**
     * @param null $DateRealDE
     */
    public function setDateRealDE($DateRealDE)
    {
        $this->DateRealDE = $DateRealDE;
    }


}
