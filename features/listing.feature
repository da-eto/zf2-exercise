Feature: As a site user
  I should see vacancies on mainpage

  Background: Existent departments
    Given there are departments on site:
      | name          |
      | IT Department |
      | Sales         |

  Scenario: User see vacancy with department name
    Given there are vacancies on site:
      | name       | department    | description |
      | Programmer | IT Department | PHP Lead    |
    And I am on homepage
    Then I should see "Programmer"
    And I should see "IT Department"
    And I should see "PHP Lead"
    But I should not see "Management"

  Scenario: User see multiple vacancies
    Given there are vacancies on site:
      | name       | department    |
      | Programmer | IT Department |
      | Manager    | Sales         |
      | Engineer   | IT Department |
    And I am on homepage
    Then I should see "Programmer"
    And I should see "Manager"
    And I should see "Engineer"

  Scenario: User see no vacancies
    Given I am on homepage
    Then I should see "No vacancies found"
