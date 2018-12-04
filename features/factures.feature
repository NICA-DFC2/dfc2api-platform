# features/factures.feature
Feature: Factures
  In order to use the application
  I need to be able to read Factures trough the API.

  Scenario: Read List Factures If not authorized NOK
    When after authentication with method "POST" on "login_check" as "use" with password "tes", i send an authenticated "GET" request to "/api/factures" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

    @dropSchema
    Scenario: Read List Factures with filter If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/factures" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"


    @dropSchema
    Scenario: Read one Facture If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/factures?IdDocDE[equals]=356829" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
