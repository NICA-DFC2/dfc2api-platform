# features/articles.feature
Feature: Article
  In order to use the application
  I need to be able to read articles trough the API.

  Scenario: Read Article If not authorized NOK
    When I send a "GET" request to "/api/articles/7"
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Read List Articles If not authorized NOK
    When I send a "GET" request to "/api/articles"
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"




  @dropSchema
  Scenario: Read Article If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/articles/7" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
      {
    "@context": "/api/contexts/Article",
    "@id": "/api/articles/7",
    "@type": "Article",
    "IdAD": 7,
    "IdArtEvoAD": 95674,
    "DesiAD": "Premier article",
    "DesiPrincAD": "Premier article",
    "DescriWebAD": "description du premier article",
    "DescriCatalogAD": "",
    "MediasAD": "",
    "PlusAD": "",
    "MotsClesAD": "test mc",
    "OrdreAD": 0,
    "NumDecliAD": 1,
    "FlgAncAD": false,
    "FlgCatalogAD": true,
    "FlgPrincAD": true,
    "FlgDestockAD": false,
    "FlgHorsMarqueAD": false,
    "FlgNouvAD": false,
    "FlgPromoAD": false,
    "FlgVisibleAD": true,
    "FlgEclBleuAD": true,
    "FlgEclRoseAD": true,
    "FlgEclVertAD": true,
    "FlgEclOrangeAD": true,
    "IdFourAD": 0,
    "DateCreAD": "2018-06-11T07:28:45+00:00",
    "DateModAD": "2018-06-11T07:28:45+00:00",
    "UCreAD": "NICA",
    "UModAD": "NICA",
    "IdADWS": 248091,
    "NoADWS": 28365,
    "CodADFWS": "110143",
    "DesiADWS": "EXTENSION DE SONNERIE  IER2",
    "CodADWS": "AP110143",
    "UVteADWS": "PCE",
    "UStoADWS": "PCE",
    "PrixPubADWS": 40,
    "PrixNetCliADWS": 40,
    "Stocks": {
        "logistique": {
            "IdDep": 5,
            "NomDep": "LOGISTIQUE",
            "StkReelAD": 1,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 1,
            "StockDisponibleSoc": 3,
            "StockPratique": 1,
            "StkReelPlat1": 0
        },
        "vertou": {
            "IdDep": 1,
            "NomDep": "VERTOU",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "02",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "brest": {
            "IdDep": 10,
            "NomDep": "BREST",
            "StkReelAD": 2,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 2,
            "StockDisponibleSoc": 3,
            "StockPratique": 2,
            "StkReelPlat1": 0
        },
        "loudeac": {
            "IdDep": 7,
            "NomDep": "LOUDEAC",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "vannes": {
            "IdDep": 8,
            "NomDep": "VANNES",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "02",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "veh_outillage": {
            "IdDep": 11,
            "NomDep": "VEH_OUTILLAGE",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "demo_epi": {
            "IdDep": 14,
            "NomDep": "DEMO_EPI",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "02",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "sav": {
            "IdDep": 15,
            "NomDep": "SAV",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        },
        "stocks_voitures": {
            "IdDep": 6,
            "NomDep": "STOCKS_VOITURES",
            "StkReelAD": 0,
            "StkResAD": 0,
            "StkCmdeAD": 0,
            "CodGesStkAD": "01",
            "StockDisponible": 0,
            "StockDisponibleSoc": 3,
            "StockPratique": 0,
            "StkReelPlat1": 0
        }
    }
}
    """
  @dropSchema
  Scenario: Read List Articles If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/articles" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
      {
    "@context": "/api/contexts/Article",
    "@id": "/api/articles",
    "@type": "hydra:Collection",
    "hydra:member": [
        {
            "@id": "/api/articles/7",
            "@type": "Article",
            "IdAD": 7,
            "IdArtEvoAD": 95674,
            "DesiAD": "Premier article",
            "DesiPrincAD": "Premier article",
            "DescriWebAD": "description du premier article",
            "DescriCatalogAD": "",
            "MediasAD": "",
            "PlusAD": "",
            "MotsClesAD": "test mc",
            "OrdreAD": 0,
            "NumDecliAD": 1,
            "FlgAncAD": false,
            "FlgCatalogAD": true,
            "FlgPrincAD": true,
            "FlgDestockAD": false,
            "FlgHorsMarqueAD": false,
            "FlgNouvAD": false,
            "FlgPromoAD": false,
            "FlgVisibleAD": true,
            "FlgEclBleuAD": true,
            "FlgEclRoseAD": true,
            "FlgEclVertAD": true,
            "FlgEclOrangeAD": true,
            "IdFourAD": 0,
            "DateCreAD": "2018-06-11T07:28:45+00:00",
            "DateModAD": "2018-06-11T07:28:45+00:00",
            "UCreAD": "NICA",
            "UModAD": "NICA",
            "IdADWS": 248091,
            "NoADWS": 28365,
            "CodADFWS": "110143",
            "DesiADWS": "EXTENSION DE SONNERIE  IER2",
            "CodADWS": "AP110143",
            "UVteADWS": "PCE",
            "UStoADWS": "PCE",
            "PrixPubADWS": 40,
            "PrixNetCliADWS": 40,
            "Stocks": {
                "logistique": {
                    "IdDep": 5,
                    "NomDep": "LOGISTIQUE",
                    "StkReelAD": 1,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 1,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 1,
                    "StkReelPlat1": 0
                },
                "vertou": {
                    "IdDep": 1,
                    "NomDep": "VERTOU",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "02",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "brest": {
                    "IdDep": 10,
                    "NomDep": "BREST",
                    "StkReelAD": 2,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 2,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 2,
                    "StkReelPlat1": 0
                },
                "loudeac": {
                    "IdDep": 7,
                    "NomDep": "LOUDEAC",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "vannes": {
                    "IdDep": 8,
                    "NomDep": "VANNES",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "02",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "veh_outillage": {
                    "IdDep": 11,
                    "NomDep": "VEH_OUTILLAGE",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "demo_epi": {
                    "IdDep": 14,
                    "NomDep": "DEMO_EPI",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "02",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "sav": {
                    "IdDep": 15,
                    "NomDep": "SAV",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                },
                "stocks_voitures": {
                    "IdDep": 6,
                    "NomDep": "STOCKS_VOITURES",
                    "StkReelAD": 0,
                    "StkResAD": 0,
                    "StkCmdeAD": 0,
                    "CodGesStkAD": "01",
                    "StockDisponible": 0,
                    "StockDisponibleSoc": 3,
                    "StockPratique": 0,
                    "StkReelPlat1": 0
                }
            }
        }
    ],
    "hydra:totalItems": 1
}
    """

