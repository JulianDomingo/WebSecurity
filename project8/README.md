# Project 8: Pentesting Live Targets

Time spent: **10** hours spent in total

> Objective: Identify vulnerabilities in three different versions of the Globitek website: blue, green, and red.

The six possible exploits are:
    * Username Enumeration
    * Insecure Direct Object Reference (IDOR)
    * SQL Injection (SQLi)
    * Cross-Site Scripting (XSS)
    * Cross-Site Request Forgery (CSRF)
    * Session Hijacking/Fixation

Each version of the site has been given two of the six vulnerabilities (In other words, all six of the exploits should be assignable to one of the sites).

## Blue
SQL Injection: Inserting a sleep command in the URL parameter successfully executes.
Command used (enclosed in double quotes): "' OR sleep(5)--'"

Session Hijacking: As the instructions have indicated, open 2 different browsers, logging into the browser to attack then copying the session ID to replace the session ID of the hacker's browser allows the hacker full access of the staff pages without having to log in.


## Red
CSRF: CSRF tokens aren't checked, so when a privileged user clicks on a malicious file with an embedded form, non-public information is changed (salesperson credentials).

IDOR: Some salespeople (id = 10, id = 11) aren't visible to the public. The red site doesn't take any preventative measures, specifically checking for the 10/11 ID values if someone were to simply change the query parameters to the hidden salespeople.

## Green
XSS: Feedback form isn't sanitized to detect scripts. As such, a privileged user will be affected by it when checking the feedback page.

Username Enumeration: Attempting to login changes the CSS of the page. Specifically, the error login message is bolded on an incorrect login with a CORRECT username, but unbolded when the username is INCORRECT.

## Remarks
CSRF form is included in project 8's repo.
