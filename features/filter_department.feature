Feature: As a site user
  I can filter vacancies by departments

  Background: Existent departments
    Given there are departments on site:
      | name          |
      | IT Department |
      | Sales         |

  Scenario: User filter vacancies and found some
    Given there are vacancies on site:
      | name       | department    |
      | Programmer | IT Department |
      | Engineer   | IT Department |
      | Manager    | Sales         |
    And I am on homepage
    Then I select "IT Department" from "Department"
    And press "Filter"
    Then I should see "Programmer"
    And should see "Programmer"
    And should see "Engineer"
    But I should not see "Manager"

  Scenario: User filter vacancies and found nothing
    Given there are vacancies on site:
      | name    | department |
      | Manager | Sales      |
    And I am on homepage
    Then I select "IT Department" from "Department"
    And press "Filter"
    Then I should see "No vacancies found"
    But I should not see "Manager"
