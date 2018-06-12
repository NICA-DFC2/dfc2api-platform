# features/users.feature
Feature: User
  In order to use the application
  I need to be able to create and update users trough the API.

  Scenario: Read User If not authorized NOK
    When I send a "GET" request to "/api/users/3"
    Then the response status code should be 403
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  @dropSchema
  Scenario: Read User If Authorized OK
    When after authentication with method "POST" on "login_check" as "NICA" with password "DFC2info", i send an authenticated "GET" request to "/api/users/3" with body:
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
      {
          "token": "eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1JFQURFUiIsIlJPTEVfVVNFUiJdLCJ1c2VybmFtZSI6Ik5JQ0EiLCJpYXQiOjE1Mjg3OTI0ODgsImV4cCI6MTUyODc5NjA4OH0.lq-ew9huUlGbL8j-DkZi4H7Z-wa_Lnv64PQXlOZ9O_pFs_2jzz44djWMd528Ifq-5-S42nWwTiOAnSqWhlyETC_9bhYrd48LEorxluTt9t9Ikog3dJhAlu_QKnJms2QaebW6FrW_1HGiEEbZl-Wj_hxx-bw93oFHLJpur8vGisOMaE7QM_GBho8cO6IzGyk3ryKw3IC9XpwCwifAeAm9PxiLRmN8Ab7-KoZ9cqiz-L2hFg9EbPRlaUGdELEwtOPNXQhIbniOeLS8hwFhSVRGhbRLpNObMX9xw0tHBXrTBhVwlhZUftEdRAwKHQ3c2sAdpnVkp-wLy64ABNTI1UFkrSqnQ9wIAQwM5Dgiti8KKo2P6YuA5wplqABQwDIwVf12L_1bAEHTyhg9FJyWzxpn6P3Y7e_OLX1nMMiM0Lgd608hdr8d7ihkxIn0hBI4k2UoheNREY_pneM9EwcrZHJPgk_w91LWDO9doJKiYdh0sQEypkUdaDxSFlqwdXPDiyK0VDMypt-YjF7Pf4B-18dQUIQR7Iu6c3Ne4KkzQ-BZRVodmyfmpOZ0ZKB4RCl4keJdqj9yuNOuXOV40ZeCANLRgFl3TssXkBMu0dztkQYfyliBdKA9DhxRMeRP7qfgB0Cx5URsJpvR9JKhAvYLVXwVY5fTlWXo2zUwPWW1OAShKHE",
          "user": {
              "id": 3,
              "username": "NICA",
              "code": "PERSO124",
              "fullname": "Nicolas Cartier",
              "email": "n.cartier@dfc2.biz",
              "last_login": {
                  "date": "2018-06-12 08:34:48.048883",
                  "timezone_type": 3,
                  "timezone": "UTC"
              },
              "raison_sociale": "Cartier Nicolas",
              "id_cli": 56610,
              "no_cli": 3850,
              "id_depot_cli": 1,
              "nom_depot_cli": "DFC² NANTES",
              "roles": [
                  "ROLE_READER",
                  "ROLE_USER"
              ],
              "cntx_valid": true
          }
      }
    """
