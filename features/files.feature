Feature:
  In order to manage file assets
  As a user
  I want to access file panel

  Scenario: List all files
    Given there are stored files
    When I am on "/files"
    Then I should see "avatar-default.jpg"
    And I should see "testimg.jpg"

  Scenario: Search for specific file
    Given I am on "/files"
    When I fill in "search" with "vatar"
    And I press "submit"
    Then I should be on "/search"
    And I should see "avatar-default.jpg"
    And I should not see "testimg.jpg"
