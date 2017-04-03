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
<img src='blob:http://imgur.com/6231a01a-4dc7-4e24-8625-ee34f651bc78' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

Session Hijacking: As the instructions have indicated, open 2 different browsers, logging into the browser to attack then copying the session ID to replace the session ID of the hacker's browser allows the hacker full access of the staff pages without having to log in.
<img src='blob:http://imgur.com/a49e05bb-ea95-4c63-88a3-c0c7e8e03afd' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

## Red
CSRF: CSRF tokens aren't checked, so when a privileged user clicks on a malicious file with an embedded form, non-public information is changed (salesperson credentials).
<img src='blob:http://imgur.com/0fa5d314-4e7c-4a6f-89c5-fbd3e2c4aecc' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

IDOR: Some salespeople (id = 10, id = 11) aren't visible to the public. The red site doesn't take any preventative measures, specifically checking for the 10/11 ID values if someone were to simply change the query parameters to the hidden salespeople.
<img src='blob:http://imgur.com/0fa5d314-4e7c-4a6f-89c5-fbd3e2c4aecc' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

## Green
XSS: Feedback form isn't sanitized to detect scripts. As such, a privileged user will be affected by it when checking the feedback page.
<img src='blob:http://imgur.com/4214ad8a-3943-4982-9c5b-9c830e6e3006' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

Username Enumeration: Attempting to login changes the CSS of the page. Specifically, the error login message is bolded on an incorrect login with a CORRECT username, but unbolded when the username is INCORRECT.
<img src='blob:http://imgur.com/e9958b34-c640-420b-b863-10886f6e09f2' title='Video Walkthrough' width='' alt='Video Walkrouugh' />

## Remarks
CSRF form is included in project 8's repo.
