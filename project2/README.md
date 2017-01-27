# Project 2 - Input/Output Sanitization

Time spent: **20** hours spent in total

## User Stories

The following **required** functionality is completed:

1. Required: Import the Starting Database

2. Required: Set Up the Starting Code

3. Required: Review code for Staff CMS for Users

4. Required: Complete Staff CMS for Salespeople
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

5. Required: Complete Staff CMS for States
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

6. Required: Complete Staff CMS for Territories
  * [X]  Required: index.php
  * [X]  Required: show.php
  * [X]  Required: new.php
  * [X]  Required: edit.php

7. Required: Add Data Validations
  * [X]  Required: Validate that no values are left blank.
  * [X]  Required: Validate that all string values are less than 255 characters.
  * [X]  Required: Validate that usernames contain only the whitelisted characters.
  * [X]  Required: Validate that phone numbers contain only the whitelisted characters.
  * [X]  Required: Validate that email addresses contain only whitelisted characters.
  * [X]  Required: Add *at least 5* other validations of your choosing.

8. Required: Sanitization
  * [X]  Required: All input and dynamic output should be sanitized.
  * [X]  Required: Sanitize dynamic data for URLs
  * [X]  Required: Sanitize dynamic data for HTML
  * [X]  Required: Sanitize dynamic data for SQL

9. Required: Penetration Testing
  * [X]  Required: Verify form inputs are not vulnerable to SQLI attacks.
  * [X]  Required: Verify query strings are not vulnerable to SQLI attacks.
  * [X]  Required: Verify form inputs are not vulnerable to XSS attacks.
  * [X]  Required: Verify query strings are not vulnerable to XSS attacks.
  * [X]  Required: Listed other bugs or security vulnerabilities


The following advanced user stories are optional:

- [X]  Bonus: On "public/staff/territories/show.php", display the name of the state.

- [X]  Bonus: Validate the uniqueness of `users.username`.

- [X]  Bonus: Add a page for "public/staff/users/delete.php".

- [X]  Bonus: Add a Staff CMS for countries.

- [X]  Advanced: Nest the CMS for states inside of the Staff CMS for countries


## Video Walkthrough

Here's a walkthrough of implemented user stories:
Link: http://i.giphy.com/d1E1LGfax3i0VBC0.gif

<img src='http://i.giphy.com/d1E1LGfax3i0VBC0.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

- I spent a lot of time trying to figure out why my show.php and edit.php files weren't working, realizing that I needed to provide the HTTP query string after the page name + "?" in order to display the specific user's page.
- Ensuring the input and dynamic output is sanitized, validated, and resistant to SQL injections / XSS attacks.
- I was troubled for a while in determining a way to prevent URL SQL injections. I kept trying to try different techniques directly on the SQL Query statement, but eventually I realized since the user is modifying the URL, I should simply check if the URL query is a numeric value using "is_numeric($_GET[query_parameter])." This would prevent any kind of SQL Injection, as it requires alphabetic letters.
- The sheer amount of code was somewhat challenging in the sense of managing the dependencies of the other CMS's when changing a certain CMS (i.e. links, query parameters, etc.).

Describe any challenges encountered while building the app.

## License

    Copyright [2017] [Julian Domingo]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.