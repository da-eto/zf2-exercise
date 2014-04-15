Feature: As a site user
  I should see vacancies on mainpage

  Background: Existent departments
    Given there are departments on site:
      | name         |
      | Technologies |
      | Sales        |

  Scenario: See vacancy with department name
    Given there are vacancies on site:
      | name       | department   |
      | Programmer | Technologies |
    And I am on homepage
    Then I should see "Programmer"
    And I should see "Technologies"
    But I should not see "Management"

  Scenario: See multiple vacancies
    Given there are vacancies on site:
      | name       | department   |
      | Programmer | Technologies |
      | Manager    | Sales        |
      | Engineer   | Technologies |
    And I am on homepage
    Then I should see "Programmer"
    And I should see "Manager"
    And I should see "Engineer"