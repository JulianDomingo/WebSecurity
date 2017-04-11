#Project 10 - Honeypot

Time spent: **2** hours spent in total

> Objective: Setup a honeypot and provide a working demonstration of its features.

### Required: Overview & Setup

- [X] A basic writeup (250-500 words) on the `README.md` desribing the overall approach, resources/tools used, findings:
    Following the instructions provided in the assignment tab, I setup the honeypot environment through use of 2 vagrant VM's: a honeypot VM and a server VM. Inside the server, the actual honeypot is stored. I git cloned the 'mhn' honeypot, which detects other honeypots through a "honeypot sensor management" UI in addition to attacks on the 'mhn' honeypot. A variety of useful information about honeypot attacks are gathered: date, the sensor, country, source IP, destination port, protocol, and the type of honeypot. Inside of the honeypot VM, I dispatched the Ubuntu-specific "dionaea" honeypot (since the server runs on 12.0X Ubuntu Linux), allowing for the 'mhn' browser to detect and trap malware. Finally, I open up a shell on the server VM to run nmap on the 'mhn' browser to view all ports visiting the network, and record them in the 'mhn' attacks report tab.
 
- [X] A specific, reproducible honeypot setup, ideally automated. There are several possibilities for this:
    - A Vagrantfile or Dockerfile which provisions the honeypot as a VM or container
    - A bash script that installs and configures the honeypot for a specific OS
    - Alternatively, **detailed** notes added to the `README.md` regarding the setup, requirements, features, etc.
    The repo contains all necessary files to setup the honeypot environment. Simply vagrant up, install the honeypot and server VM's, download all dependencies provided in the codepath assignment 9 tab, then run an nmap attack on the URL of the 'mhn' admin browser.

### Required: Demonstration

- [X] A basic writeup of the attack (what offensive tools were used, what specifically was detected by the honeypot)
    ^ Provided in the writeup above.
- [X] An example of the data captured by the honeypot (example: IDS logs including IP, request paths, alerts triggered)
    - Included in the GIF below.
- [X] A screen-cap of the attack being conducted
<img src="//media.giphy.com/media/3o7bui0Q1ifntSUp1u/giphy.gif">
 
### Optional: Features
- Honeypot
    - [ ] HTTPS enabled (self-signed SSL cert)
    - [ ] A web application with both authenticated and unauthenticated footprint
    - [ ] Database back-end
    - [ ] Custom exploits (example: intentionally added SQLI vulnerabilities)
    - [ ] Custom traps (example: modified version of known vulnerability to prevent full exploitation)
    - [ ] Custom IDS alert (example: email sent when footprinting detected)
    - [ ] Custom incident response (example: IDS alert triggers added firewall rule to block an IP)
- Demonstration
    - [ ] Additional attack demos/writeups
    - [ ] Captured malicious payload
    - [ ] Enhanced logging of exploit post-exploit activity (example: attacker-initiated commands captured and logged)
