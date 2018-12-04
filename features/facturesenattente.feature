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
