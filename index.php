<?php

/*
 * @author
 * Eswar Rajesh Pinapala | epinapala@live.com
 * Developed for eBay internal use.
 */

define('d', date("m/d/Y"));
set_include_path(get_include_path() . PATH_SEPARATOR . "src" . PATH_SEPARATOR . "utils");

include_once "LiveIdManager.php";
include_once "EntityUtils.php";
include_once 'PrintUtils.php';
include_once 'CrmAPI.php';

$liveIDUseranme = "Your CRM Username";
$liveIDPassword = "YOUR CRM Password";

$organizationServiceURL = "https://yourOrgName.api.crm.dynamics.com/XRMServices/2011/Organization.svc";// Get it from home > customizations > Developer Resources
$liveIDManager = new LiveIDManager();

$securityData = $liveIDManager->authenticateWithLiveID($organizationServiceURL, $liveIDUseranme, $liveIDPassword);

if ($securityData != null && isset($securityData)) {
    echo ("\nKey Identifier:" . $securityData->getKeyIdentifier());
    echo ("\nSecurity Token 1:" . $securityData->getSecurityToken0());
    echo ("\nSecurity Token 2:" . $securityData->getSecurityToken1());
} else {
    echo "Unable to authenticate LiveId.";
    return;
}
echo "\n";

$accountId = CrmAPI::createOrg($organizationServiceURL, $securityData, "New Org created by Rajesh\'s app");

PrintUtils::dump(CrmAPI::readOrg($accountId, $organizationServiceURL, $securityData));

CrmAPI::updateOrg($accountId, $organizationServiceURL, $securityData, "New Org name Updated by Rajesh\'s app_" . d);
PrintUtils::dump(CrmAPI::readOrg($accountId, $organizationServiceURL, $securityData));

//Uncomment only if you want to delete the created org
//deleteAccount($accountId, $organizationServiceURL, $securityData);