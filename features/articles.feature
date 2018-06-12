# features/articles.feature
Feature: Article
  In order to use the application
  I need to be able to read articles trough the API.

  Scenario: Read Article If not authorized NOK
    When I send a "GET" request to "/api/articles/7"
    Then the response status code should be 403
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"


  @dropSchema
  Scenario: Read Article If Authorized OK
    When after authentication with method "POST" on "login_check" as "NICA" with password "DFC2info", i send an authenticated "GET" request to "/api/articles/7" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
      {
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
        "IdADWS": 273780,
        "NoADWS": 28365,
        "CodADFWS": "110143",
        "DesiADWS": "EXTENSION DE SONNERIE  IER2",
        "CodADWS": "AP110143",
        "UVteADWS": "PCE",
        "UStoADWS": "PCE",
        "PrixPubADWS": 40,
        "PrixNetCliADWS": 24.64,
        "Stocks": [
            {
                "IdDep": 5,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 1,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 1,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 1,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "02",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 10,
                "StkReelAD": 2,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 2,
                "StockDisponibleSoc": 2,
                "StockPratique": 2,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 7,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 8,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "02",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 11,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 14,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "02",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 15,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            },
            {
                "IdDep": 6,
                "StkReelAD": 0,
                "StkResAD": 0,
                "StkCmdeAD": 0,
                "CodGesStkAD": "01",
                "EtatStockAD": "",
                "StockDisponible": 0,
                "StockDisponibleSoc": 2,
                "StockPratique": 0,
                "StkReelPlat1": 0
            }
        ]
    }
    """