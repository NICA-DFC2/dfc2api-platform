# features/users.feature
Feature: User
  In order to use the application
  I need to be able to create and update users trough the API.

  Scenario: Read User If not authorized NOK
    When I send a "GET" request to "/api/users/3"
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "code" should be equal to "401"
    And the JSON node "message" should be equal to "Le Token n'a pas été trouvé"


  Scenario: Read User If not authorized NOK
    Given I add "Authorization" header equal to "Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1JFQURFUiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6Ik5JQ0EiLCJpYXQiOjE1Mjg5ODgxMzIsImV4cCI6MTUyODk5MTczMn0.fzbXSPae1M4QDcATYmpyMbSHqV5GglzwOjKc31itzyvYdo9BV6lW_lAQlzFsTuND1QB1pdfTA2dtDdCRjE2zmxwKoClLUyDHr1uCH6XotNDmL0D4vVGA_9TYTDXTo_KrVMI48wRtNAms_gmidFA1nTXA4Ns9iDcQ7wAZjEOW17dxKBYV2PFPPqYoD_FX3F1Fj9mV-m1eMsQtH5lMdne_pGvd6Yy2eMKQh2nIxeudkUKYkB76bUdRuHAaqRvNjbOLML9yC1kNjkNJ1L1naH8Z7PYwNJCvLUDD1BxHswOr7yPmRUNwUkXG5oF0U3q1DA3eKt4cO0pboDqvpWQG10wJH1mCgCgY_n-KPwwk728YhICUVJJkN6PYuw067HJm6euHu0NWxyXSu5A2tCw76QY51BEe0ST78m6N5Ve9dncdcQOSqLhnr3zUciv5sNdeM1q_kM1ffMtnMmEJq64pOGbuntBgoz6BmPk4xKut35JFKbtOay5wyYTtsUpAy7qV-tzerHqMSPsXiOAxc5zmySefF2KCQPcfULRJCKnpyr8gCHgJo2kejEcEVcheDLHDJbPvQM8U_VeWz_QPI8cPP-iAtVlmGLe4V7yCPhTQRplE9kUNBNGJrS9jIgFblZeX2bPD2Zm3-6hb11oO6fLFpLReUQv3is9W6suO9tgO2dqVv9M"
    When I send a "GET" request to "/api/users/3"
    Then the response status code should be 504
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "code" should be equal to "504"


  Scenario: Read User If not authorized NOK
    Given I add "Authorization" header equal to "Bearer eyJhbGciOiJSUzI1NiJ9.IVWMaGNZGrDDlxPAkUCPC4AH1o481sdqEQGhHlyQFB8BP5gFhIEdEpu6fMLG08MZ-JB65mXau9lCsVEoygG5l8q3u3lED6BfjYBhTAEP0KiUWLCDnX08uMVEADVoTLeT5yMqhlVKiZ5Vq3S9CG120SiQgAnie5JetHlS6cKHrpwaxxqX3VzMQoTFenXmL0nGn37iBIpEFLHI08T3PkSpIiOfhSG2UEB67QysoTcQJCY4gSXIWoq2z-ogG1EM1QLUD0pZbuJayfQ2yd8KJ8a6uiUoHlaYXO6P5c7a6lmergYf2B1B4zHkLjkW-iRA-lxLTXH9gED44bNzZThz7vaMXJeiIUvXTyIDHhiJr5CSTEdnHm1Jg6V-BSZfGF8--4V9vY-NuoiBQlvXxRUTQLxPGclfWvG63TaYM06LkhVeF2IS7kCFGgbx_MxsZHySSg0t7YfJG3toyJNCaccQgLfEWjbEhXV04v95n08_Mgx1z22jF3rNttZfHOTMz5vSYiB3GutqN_vsGrLcCH1bMSD8U-3yHoCYn6ZZNzhBoiolGCPRQ53u5jLXqRfE6l7phz4kQO5NCvEXgCd_GoI9HR2Fv7cwzLeUM6_F66vcHK5s7bvSvoCg8RnewYn8G8JBnWJ_1yfoqs_xYtnZ42QAyReqVJThyI6Po6P4SCeEaqZ8uzk"
    When I send a "GET" request to "/api/users/3"
    Then the response status code should be 504
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "code" should be equal to "504"


  Scenario: Read User If not authorized NOK
    When after authentication with method "POST" on "login_check" as "userr" with password "test", i send an authenticated "GET" request to "/api/users/3" with body:
    Then the response status code should be 401
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON node "code" should be equal to "401"
    And the JSON node "message" should be equal to "Votre connexion a expirée, veuillez vous reconnecter"


  @dropSchema
  Scenario: Read User If Authorized OK
    When after authentication with method "POST" on "login_check" as "user" with password "test", i send an authenticated "GET" request to "/api/users/3" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"

