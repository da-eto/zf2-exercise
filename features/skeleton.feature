Feature: As a developer
  I want to have configured ZF2 skeleton
  So I check mainpage welcome text

  Scenario: Check mainpage for welcome message
    Given I am on homepage
    Then I should see "Welcome"
