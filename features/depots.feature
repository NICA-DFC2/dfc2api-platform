# features/depots.feature
Feature: Depots
  In order to use the application
  I need to be able to read Depots trough the API.

  Scenario: Read List Depots If not authorized NOK
    When after authentication with method "POST" on "login_check" as "use" with password "tes", i send an authenticated "GET" request to "/api/depots" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

    @dropSchema
    Scenario: Read List Depots with filter If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/depots" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
[
    {
        "IdDep": 1,
        "NomDep": "VERTOU",
        "nomDepLower": "vertou",
        "nomDepUCFirst": "Vertou",
        "CodDep": "DFC² VERTOU",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 2,
        "NomDep": "DFC2 BRETAGNE",
        "nomDepLower": "dfc2 bretagne",
        "nomDepUCFirst": "Dfc2 bretagne",
        "CodDep": "DFC2B",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 4,
        "NomDep": "DFC2D",
        "nomDepLower": "dfc2d",
        "nomDepUCFirst": "Dfc2d",
        "CodDep": "DFC2D",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 5,
        "NomDep": "LOGISTIQUE",
        "nomDepLower": "logistique",
        "nomDepUCFirst": "Logistique",
        "CodDep": "DFC2P",
        "FlgPlateformeDep": true,
        "FlgActifDep": true
    },
    {
        "IdDep": 6,
        "NomDep": "STOCKS_VOITURES",
        "nomDepLower": "stocks_voitures",
        "nomDepUCFirst": "Stocks_voitures",
        "CodDep": "STKV",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 7,
        "NomDep": "LOUDEAC",
        "nomDepLower": "loudeac",
        "nomDepUCFirst": "Loudeac",
        "CodDep": "DFC² LOUDEAC",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 8,
        "NomDep": "VANNES",
        "nomDepLower": "vannes",
        "nomDepUCFirst": "Vannes",
        "CodDep": "DFC² VANNES",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 10,
        "NomDep": "BREST",
        "nomDepLower": "brest",
        "nomDepUCFirst": "Brest",
        "CodDep": "DFC² BREST",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    },
    {
        "IdDep": 11,
        "NomDep": "VEH_OUTILLAGE",
        "nomDepLower": "veh_outillage",
        "nomDepUCFirst": "Veh_outillage",
        "CodDep": "DFC²O ATLANT",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    }
]
      """

    @dropSchema
    Scenario: Read one Depot If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/depots/1" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
[
    {
        "IdDep": 1,
        "NomDep": "VERTOU",
        "nomDepLower": "vertou",
        "nomDepUCFirst": "Vertou",
        "CodDep": "DFC² VERTOU",
        "FlgPlateformeDep": false,
        "FlgActifDep": true
    }
   ]
      """