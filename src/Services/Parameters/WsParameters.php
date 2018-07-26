<?php

namespace App\Services\Parameters;

class WsParameters
{
    public const URL_SUFFIX = '/Dfc2WS/rest/Evo2Rest/Evolubat';
    public const REFERER = 'http://www.dfc2.fr/';
    public const CONTENT_TYPE = 'application/json';
    public const ACCEPT = 'application/json';
    public const ORIGIN = 'http://www.dfc2.fr';

    public const ID_DEP_PLATEFORME = 5;

    public const MODULE_DEMARRE = 'Demarre';
    public const MODULE_ARTICLE = 'Article';
    public const MODULE_CATEGORIE = 'Categorie';
    public const MODULE_CHANTIER = 'Chantier';
    public const MODULE_CLIENT = 'Client';
    public const MODULE_CONTACT = 'Contact';
    public const MODULE_CONTACT2 = 'Contact2';
    public const MODULE_DEPOT = 'Depot';
    public const MODULE_DOCUMENT = 'Document';
    public const MODULE_EDITION = 'Edition';
    public const MODULE_FACCLIATT = 'FacCliAtt';
    public const MODULE_INSTANCE_CATEGORIE = 'InstanceCategorie';
    public const MODULE_INSTANCE_TACHE_WORKFLOW = 'InstTacheWF';
    public const MODULE_LIBELLE = 'Libelle';
    public const MODULE_PARAMETRE = 'Parametre';
    public const MODULE_RESSOURCE = 'Ressource';
    public const MODULE_SALARIE = 'Salarie';
    public const MODULE_STATISTIQUE = 'Statistique';
    public const MODULE_TARIF_ACHAT = 'TarAch';
    public const MODULE_TARIF = 'Tarif';
    public const MODULE_TAXE = 'Taxe';
    public const MODULE_TOURNEE = 'Tournee';
    public const MODULE_UTILISATEUR = 'Util';
    public const MODULE_VISITE = 'Visite';
    public const MODULE_FOURNISSEUR = 'Fournisseur';

    public const TYPE_DONNEE_CLI_ADRESSE = 'CliAdresse';
    public const TYPE_DONNEE_CLI_PROSPECT = 'CliProspect';
    public const TYPE_DONNEE_CLI_VCD = 'CliVCD';

    public const TYPE_DONNEE_ARTDET_STOCK = 'ArtDetStock';
    public const TYPE_DONNEE_ARTDET_WEB = 'ArtDetWeb';
    public const TYPE_DONNEE_ARTDET = 'ArtDet';

    public const TYPE_DONNEE_INSTCAT = 'InstCat';

    public const TYPE_DONNEE_FOUR = 'Four';

    public const TYPE_RECHERCHE_ARTDET = 'ArticleCommandes';

    public const TYPE_PDS_SIMPLE = 'DocumentSimple';

    public const TYPE_PRENDRE_VALDEF_PANIER = 'ValDefAjoutPanier';
    public const TYPE_PRENDRE_BL = 'DocumentBL';
    public const TYPE_PRENDRE_DEVIS = 'DocumentDevis';
    public const TYPE_PRENDRE_CMDCLI = 'DocumentCommandeClient';
    public const TYPE_PRENDRE_FACCLI = 'DocumentFactureClient';
    public const TYPE_PRENDRE_PANIER = 'DocumentPanier';
    public const TYPE_PRENDRE_EDITION_BL = 'EditionBonLivraison';
    public const TYPE_PRENDRE_EDITION_DEVIS = 'EditionDevis';
    public const TYPE_PRENDRE_EDITION_CMDCLI = 'EditionCommandeClient';
    public const TYPE_PRENDRE_EDITION_FACCLI = 'EditionFactureClient';
    public const TYPE_PRENDRE_CONTACTWEB = 'ContactWeb';
    public const TYPE_PRENDRE_INSTCAT_BRANCHE = 'InstCatBranche';

    public const FORMAT_DOCUMENT_VIDE = ' ';
    public const FORMAT_DOCUMENT_ENT = 'Ent';
    public const FORMAT_DOCUMENT_LIG = 'Lig';

    public const FORMAT_EDITION_VIDE = ' ';
    public const FORMAT_EDITION_BLOB = 'BLOB';
    public const FORMAT_EDITION_LINK = 'LINK';
}
