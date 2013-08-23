<?php

/*
 * @author
 * Eswar Rajesh Pinapala | epinapala@live.com
 * Developed for eBay internal use.
 */

//set the timestamp
define(
        'd', 
        date(
                "m/d/Y H:i:s"
                )
        );

//concatenate src and utils to the include path on the fly
set_include_path(get_include_path() . 
        PATH_SEPARATOR . 
        "src" . 
        PATH_SEPARATOR . 
        "utils"
        );

//parse the config file 
$config = parse_ini_file(
        "config.ini", 
        true
        );

include_once "LiveIdManager.php";
include_once "EntityUtils.php";
include_once 'PrintUtils.php';
include_once 'CrmAPIContext.php';

$liveIDUseranme = $config["dynamics"]["crmUserId"];
$liveIDPassword = $config["dynamics"]["crmPassword"];
$organizationServiceURL = $config["dynamics"]["organizationServiceURL"];

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

$dynamicsCrm = new CrmAPIContext();

$accountId = $dynamicsCrm->createOrg($organizationServiceURL, $securityData, "New Org created by Rajesh\'s app" . d );

PrintUtils::dump($dynamicsCrm->readOrg($accountId, $organizationServiceURL, $securityData));

$dynamicsCrm->updateOrg($accountId, $organizationServiceURL, $securityData, "New Org name Updated by Rajesh\'s app_" . d);
PrintUtils::dump($dynamicsCrm->readOrg($accountId, $organizationServiceURL, $securityData));

//Uncomment only if you want to delete the created org
//$dynamicsCrm->deleteOrg($accountId, $organizationServiceURL, $securityData);