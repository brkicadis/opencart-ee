Feature: CreditCard3DSAuthorizationHappyPath
  As a guest  user
  I want to make an authorization with a Credit Card 3DS
  And to see that transaction was successful

  Background:
    Given I activate "creditcard" payment action "reserve" in configuration
    And I prepare checkout
    And I fill fields with "Customer data"
    Then I see "Wirecard Credit Card"

  @ui_test
  Scenario: purchase
    Given I check "I have read and agree to the Terms & Conditions"
    And I click "Continue"
    When I fill fields with "Valid Credit Card Data"
    And I click "Confirm Order"
    And I am redirected to "Verified" page
    And I enter "wirecard" in field "Password"
    And I click "Continue"
    Then I am redirected to "Order Received" page
    And I see "Your order has been placed!"
    And I see "creditcard" "authorization" in transaction table