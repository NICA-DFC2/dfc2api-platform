# features/libelles.feature
Feature: Libelles
  In order to use the application
  I need to be able to read Libelles trough the API.

  Scenario: Read List Libelles If not authorized NOK
    When after authentication with method "POST" on "login_check" as "use" with password "tes", i send an authenticated "GET" request to "/api/libelles" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

    @dropSchema
    Scenario: Read List Libelles with filter If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/libelles" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
[
    {
        "FamLIB": "ActFour",
        "CodLIB": " ",
        "CodGimLib": "",
        "LibLIB": " ",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "ActFour",
        "CodLIB": "CAMO",
        "CodGimLib": "",
        "LibLIB": "Contrôle d'Accès & Motorisation",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "ActFour",
        "CodLIB": "CONSO",
        "CodGimLib": "",
        "LibLIB": "Marché Consommable",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "ActFour",
        "CodLIB": "CSP 9 - 1",
        "CodGimLib": "",
        "LibLIB": "INDUSTRIE",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "ActFour",
        "CodLIB": "EQPO",
        "CodGimLib": "",
        "LibLIB": "Equipement de la Porte",
        "RgpLib": "DFC2"
    }
]
      """

    @dropSchema
    Scenario: Read one Libelle of family TypeCC If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/libelles?FamLIB[equals]=TypeCC" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
[
{
        "FamLIB": "TypeCC",
        "CodLIB": "C",
        "CodGimLib": "CPT",
        "LibLIB": "Vente comptant",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "TypeCC",
        "CodLIB": "Dep",
        "CodGimLib": "DEP",
        "LibLIB": "Transfert Dépot",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "TypeCC",
        "CodLIB": "OF",
        "CodGimLib": "OF",
        "LibLIB": "Ordre de fabrication",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "TypeCC",
        "CodLIB": "R",
        "CodGimLib": "REL",
        "LibLIB": "Fin de mois",
        "RgpLib": "DFC2"
    },
    {
        "FamLIB": "TypeCC",
        "CodLIB": "V",
        "CodGimLib": "VCD",
        "LibLIB": "Vente comptant différée",
        "RgpLib": "DFC2"
    }
   ]
      """