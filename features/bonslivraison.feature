# features/bonslivraison.feature
Feature: BonLivraison
  In order to use the application
  I need to be able to read bons livraison trough the API.

  Scenario: Read List Bons Livraison If not authorized NOK
    When after authentication with method "POST" on "login_check" as "use" with password "tes", i send an authenticated "GET" request to "/api/bonslivraison" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"


  @dropSchema
  Scenario: Read Bon Livraison If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/bonslivraison" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

  @dropSchema
  Scenario: Read List Bons Livraison with filter If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/bonslivraison?IdDocDE[equals]=785215" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"


