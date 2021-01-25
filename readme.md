# ONAC

## Open News Aggregator Community

ONAC is an experimental, open source, proof of concept, community based, news aggregator. This is not an original idea, but sometimes reinventing the wheel is a good way to sharpen one's skills. In other words, it's a Digg/reddit/StumbleUpon clone.

I developed ONAC using *two* servers, a database server, and a web server. This may be performant if this project becomes useful, however, it is not a hard requirement. Your due diligence and judgement as a sysadmin and webmaster is due. 

This project was done on Debian 10, and includes some setup scripts for said distribution. For ease of setup, you may consider using my preferences. I cannot be sure my scripts work on another distribution or platform. Use your system administration skills to interpret the scripts and adjust to your needs.

This project comes on an AS IS basis with no warranty of guarantee of support.

## How do I install ONAC?

On the machine you intend to run the database server, install Debian 10 if it is not already installed. Copy the `ONAC\db` directory and run `db_setup.sh` as root.

On the machine you intend to run the web server on, install Debian 10 if it is not already installed. Copy the `ONAC\web` directory and run `web_setup.sh` as root.

## What now?

I will update the instructions for further additional setup as the project helps. 

***Good Luck!***