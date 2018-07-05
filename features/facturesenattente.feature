# features/facturesenattentes.feature
Feature: Factures en attentes
  In order to use the application
  I need to be able to read Factures en attente trough the API.

  Scenario: Read List Factures en attentes If not authorized NOK
    When after authentication with method "POST" on "login_check" as "use" with password "tes", i send an authenticated "GET" request to "/api/factures-en-attentes" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

    @dropSchema
    Scenario: Read List Factures en attentes with filter If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/factures-en-attentes" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
[
    {
        "IdFCA": 3337,
        "IdFac": 402829,
        "IdSoc": 1,
        "IdDep": 0,
        "IdCli": 112999,
        "IdSal": 720,
        "NoFacFCA": 18021460,
        "DateFacFCA": "2018-02-28",
        "DateRegFCA": "2018-04-15",
        "DateFinRisqueFCA": "2018-04-15",
        "DateRegleFCA": null,
        "MontTotTtcFCA": 836.58,
        "ResteDuFCA": 836.58,
        "LibFCA": "Facture CONSTRUCTION METALLIQUE DU BOCAGE",
        "LibSocFCA": null,
        "TypeFCA": "Fac",
        "MRegFCA": "6",
        "CodAcceptFCA": "0",
        "CodDepartFCA": "",
        "CodImpFCA": "R",
        "CodLitFCA": "0",
        "CodReseauFCA": "1",
        "NbRelFCA": 0,
        "LettrageFCA": "",
        "AnnotFCA": "?le 28/06\nAppel Fabienne pour lui demander de régler avant le 10/07\nElle pense que ce ne sera pas possible\nLa rappeler vers le 8/07\n\n\nFrom: Compta - GROUPE DCF <compta@groupedcf.fr>\nDate: mer. 27 juin 2018 à 18:24\nSubject: RE: DFC² - Facture non réglée/rappel 2 - CMB1\nTo: Céline LEBRETON <c.lebreton@dfc2.biz>\nCc: Karelle <secretariat1@cmb85.fr>\n\n\nSuite à notre entretien téléphonique,\n\nJ’accuse réception de votre facture n° 018021460,\n\nSauf éventuel litige, sa date de règlement est prévu au 31/7/18 ;\n\n \n\nCordialement\n\n \n\n \n\ncid:image001.png@01D3426B.04F4C3C0Fabienne BROSSARD\n\nService Comptabilité\n\n?From: Céline LEBRETON <c.lebreton@dfc2.biz>\nDate: mer. 27 juin 2018 à 17:09\nSubject: Fwd: DFC² - Facture non réglée/rappel 2 - CMB1\nTo: <compta@groupedcf.fr>\n\n\nBonjour,\n\nMalgré notre première relance, votre compte présente toujours un solde débiteur de 836.58€.\n\nNous vous demandons de bien vouloir nous adresser un règlement dans les meilleurs délais ou nous contacter pour tout éventuel litige.\n\nCordialement,\n \nCéline Lebreton\nComptable\n\n\n?From: c.lebreton@dfc2.biz <c.lebreton@dfc2.biz>\nDate: jeu. 31 mai 2018 à 17:00\nSubject: DFC² - Facture non réglée/rappel 1 - CMB1\nTo: travaux02@cmb85.fr <travaux02@cmb85.fr>\nCc: a.fleurance@dfc2.biz <a.fleurance@dfc2.biz>\n\n\nBonjour,\n\nA ce jour, nous n'avons pas reçu le règlement lié à la facture ci-jointe d'un montant de 836.58€.\n\nNous vous remercions de nous établir un virement à réception, notre RIB est noté sur notre facture ou nous préciser tout éventuel litige.\n\nCordialement,\n\nDFC² DIFFUSION\nLebreton Céline\n17 rue des Entrepreneurs\nZI de la Vertonne\n44120 VERTOU\nTél. : 0 249 091 211",
        "NbJoursRetard": 86
    }
]
      """