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


    @dropSchema
    Scenario: Read one Depot If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/depots/1" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
