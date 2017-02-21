
# Project 4 - Globitek Authentication and Login Throttling

Time spent: **20** hours spent in total

## User Stories

The following **required** functionality is completed:

1\. Initial Penetration Testing
  * [X] Required: Tested for initial vulnerabilities

2\. Session Configurations
  * [X]  Required: Only allow session IDs to come from cookies
  * [X]  Required: Expire after one day
  * [X]  Required: Use cookies which are marked as HttpOnly

3\. Login Error Checking & Session Updating
  * [X]  Required: Completed login page.
  * [X]  Required: Show an error message when username is not found.
  * [X]  Required: Show an error message when username is found but password does not match.
  * [X]  Required: After login, store user ID in session data.
  * [X]  Required: After login, store user last login time in session data.
  * [X]  Required: Regenerate the session ID at the appropriate point.

4\. Login Requirements 
  * [X]  Required: Required login to access staff area pages.
  * [X]  Required: Add a login requirement to *almost all* staff area pages (the index.php files which simply redirect to another index.php don't require a login. 
  * [X]  Required: Write code for `last_login_is_recent()`.

5\. Completion of logout processes
  * [X]  Required: Add code to destroy the user's session file after logging out.

6\. CSRF Protective Measures
  * [X]  Required: Create a CSRF token.
  * [X]  Required: Add CSRF tokens to forms.
  * [X]  Required: Compare tokens against the stored version of the token.
  * [X]  Required: Only process forms data sent by POST requests.
  * [X]  Required: Confirm request referer is from the same domain as the host.
  * [X]  Required: Store the CSRF token in the user's session.
  * [X]  Required: Add the same CSRF token to the login form as a hidden input.
  * [X]  Required: When submitted, confirm that session and form tokens match.
  * [X]  Required: If tokens do not match, show an error message.
  * [X]  Required: Make sure that a logged-in user can use pages as expected.

7\. XSS Protection
  * [X]  Required: Ensure the application is not vulnerable to XSS attacks.

8\. SQLI Protection
  * [X]  Required: Ensure the application is not vulnerable to SQL Injection attacks.

9\. Final Penetration Testing
  * [X] Required: Run all tests from Objective 1 again and confirm that your application is no longer vulnerable to any test.


The following advanced user stories are optional:

* Bonus Objective 1: Identify security flaw in Objective #4 (requiring login on staff pages)
  * [X]  Identify the security principal not being followed: Defense in Depth
  * [X]  Write a short description of how the code could be modified to be more secure:
	 The objective states to add login requirements to "almost all" staff area pages, since there are some that don't require a login. However, it doesn't hurt the user to implement additional, redundant layers of security if it means decreasing the chances of a malicious attack. In my previous answer to objective #4, I stated that the redirected index.php files don't require a login. However, what if the attacker were to enter the redirected index.php directly? Since the URL is in full exposure (at least for this project), it won't take much effort to find the index.php files that don't have the require_login() method appended. Without the required login, the attacker could change the redirect_to() method to link to the attacker's malicious site through CSRF, and ultimately gain access to private information. To strengthen the security of the code, simply append the require_login() method to *all* staff pages.

* [X] Bonus Objective 2: Add CSRF protections to all forms in the staff directory

* [X]  Bonus Objective 3: CSRF tokens only valid for 10 minutes.

* [X]  Bonus Objective 4: Sessions are valid only if user-agent string matches previous value.

* Advanced Objective: Set/Get Signed-Encrypted Cookie
  * [X]  Create "public/set\_secret\_cookie.php".
  * [X]  Create "public/get\_secret\_cookie.php".
  * [X]  Encrypt and sign cookie before storing.
  * [X]  Verify cookie is signed correctly or show error message.
  * [X]  Decrypt cookie.

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='http://i.imgur.com/link/to/your/gif/file.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
