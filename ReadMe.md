----
## Overview

Dynamics CRM 2011 has a well published CRUD data and metadata API accessible through WCF and SOAP 
interfaces. These interfaces are language neutral and accessible from many different programming 
languages. This makes ISVs that are working on disparate platforms to be able to connect and exchange 
information with Dynamics CRM securely to integrate their solutions with Dynamics CRM.

Credits to Dynamics CRM 2011 Developer Training Kit : http://www.microsoft.com/en-us/download/confirmation.aspx?id=23416

Microsoft owns the code and I forked it to make it to work. 

> The Lab sample provided in the Dynamics CRM kit does not work out of the box, I tried getting this to work by making a few changes.I am sharing this with the community so that this can be helpful for others.



----
## How to run?

- First of all download - http://www.microsoft.com/en-us/download/details.aspx?id=23416 
- Read the /path/to/CRM2011Kit/labs.htm , click on Java and PHP to CRM Onlineand read the Lab manual.

Make the changes below in config.ini:

~~~~
> crmUserId = "Your CRM Username"
> crmPassword = "YOUR CRM Password"
> //organizationServiceURL - Get it from Crm Home > Customizations > Developer Resources
> organizationServiceURL = "https://yourOrgName.api.crm.dynamics.com/XRMServices/2011/Organization.svc"
~~~~


`php index.php or goto localhost/path/to/index.php in your web browser`

----
Using this sample you should be able to 
 - Authenticate on Live.com
 - Print auth tokens
 - Create an org 
 - Read the created org
 - Update the org
 - Read updated org
 - Delete the org(optional)
