Feature:
  In order to manage file assets
  As a user
  I want to access file panel

  Scenario: List everything
    Given there are stored files
    When I am on "/files"
    Then I should see "folder"
    And I should see "testpdf-subdirectory.pdf"
    And I should see "testimg.jpg"
    And I should see "testpdf.pdf"

  Scenario: Search for specific file
    Given I am on "/files"
    When I fill in "search" with "testpdf"
    And I press "submit"
    Then I should be on "/search?query=testpdf"
    And I should see "testpdf-subdirectory.pdf"
    And I should see "testpdf.pdf"
    And I should not see "folder"
    And I should not see "testimg.jpg"
  #Scenario: Do not match folder names
    When I am on "/search?query=folder"
    Then I should not see "folder"
    And I should not see "testpdf-subdirectory.pdf"
    And I should not see "testimg.jpg"
    And I should not see "testpdf.pdf"
  #Scenario: match files from subdirectories
    When I am on "/search?query=testpdf-subdirectory"
    # TODO show subdirectories for matched subdirectory files?
    Then I should not see "folder"
    And I should see "testpdf-subdirectory.pdf"
    And I should not see "testimg.jpg"
    And I should not see "testpdf.pdf"
