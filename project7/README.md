# Project 7 - WordPress Pentesting

Time spent: **X** hours spent in total

> Objective: Find, analyze, recreate, and document **five vulnerabilities** affecting an old version of WordPress

## Pentesting Report

1. Authenticated Stored Cross-Site Scripting (XSS) 
  - [X] Summary: A user with posting capabilities can input a stored XSS vulnerability on a post or page. 
    - Vulnerability types: XSS
    - Tested in version: 4.2.2
    - Fixed in version: 4.2.3
  - [ ] GIF Walkthrough: N/A
  - [ ] Steps to recreate: <a href="[caption code=">]</a><a title=" onmouseover=alert('test')  ">link</a> into a wordpress post in HTML mode. Hover mouse on "link" when viewing post.
  - [ ] Affected source code: N/A
    - [Link 1](https://ibb.co/hwUUDv)

1. Authenticated Shortcode Tags Cross-Site Scripting (XSS) 
  - [ ] Summary: XSS can be inserted into a content post by taking advantage of when validation is done using the KSES variant used by WordPress and the shortcode parsing. Since KSES validation is done first, which checks for HTML correctness, the example code below will not fail the validation done in KSES. As a result, when shortcode parsing ins finished, it leaves an unclosed 'href' attribute allowing for the attacker to inject an arbitrary <a> attribute for example to input malicious JavaScript. 
    - Vulnerability types: XSS (Through WordPress shortcode)
    - Tested in version: 4.3
    - Fixed in version: 4.4
  - [ ] GIF Walkthrough: N/A
  - [ ] Steps to recreate: Post "XSS LOL!!![caption width='1' caption='<a href="' ">]</a><a href="http://onMouseOver='alert(/xss/)' style='display:block;position:absolute;top:0px;left:0px;margin-left:-1000px;margin-top:-1000px;width:99999px;height:99999px;'"></a>" into the content of a new post, then view the post.
  - [ ] Affected source code: N/A
    - [Link 1](https://core.trac.wordpress.org/browser/tags/version/src/source_file.php)

1. Stored Cross-Site Scripting (XSS) via Theme Name fallback
  - [ ] Summary: 
    - Vulnerability types: XSS
    - Tested in version: <= 4.6.1
    - Fixed in version: 4.6.2
  - [ ] GIF Walkthrough: http://giphy.com/gifs/xUA7b4miZMcegzlj2M
  - [ ] Steps to recreate: Shown in "https://www.mehmetince.net/low-severity-wordpress/". May have to add/increase "upload_max_size" directive in php.ini to accomodate uploading theme that's > 2.2 MB (i.e. 'do upload_max_size = 64M'). Apparently by default wordpress sets upload capacity to 2.2. May also need to restart apache2 server for changes to take effect. For my case I just restarted the wordpress container itself.
  - [ ] Affected source code: The provided theme in the guidelines changes the name of the theme to a stored XSS name. Shown in the first link to "Steps to recreate."
    - [Link 1](https://core.trac.wordpress.org/browser/tags/version/src/source_file.php)
1. (Optional) Vulnerability Name or ID
  - [ ] Summary: 
    - Vulnerability types:
    - Tested in version:
    - Fixed in version: 
  - [ ] GIF Walkthrough: 
  - [ ] Steps to recreate: 
  - [ ] Affected source code:
    - [Link 1](https://core.trac.wordpress.org/browser/tags/version/src/source_file.php)
1. (Optional) Vulnerability Name or ID
  - [ ] Summary: 
    - Vulnerability types:
    - Tested in version:
    - Fixed in version: 
  - [ ] GIF Walkthrough: 
  - [ ] Steps to recreate: 
  - [ ] Affected source code:
    - [Link 1](https://core.trac.wordpress.org/browser/tags/version/src/source_file.php) 

## Assets

List any additional assets, such as scripts or files

## Resources

- [WordPress Source Browser](https://core.trac.wordpress.org/browser/)
- [WordPress Developer Reference](https://developer.wordpress.org/reference/)

GIFs created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while doing the work

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
