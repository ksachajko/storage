Feature:
  In order to manage file assets
  As a user
  I want to access file panel

  Scenario: List all files
    Given there are stored files
    When I am on "/files"
    Then I should see "avatar-default.jpg"
    Then I should see "testimg.jpg"
