<?php

include_once "DeviceIdManager.php";
include_once "SecurityData.php";


class LiveIDManager {

    public function authenticateWithLiveID($CRMUrl, $liveIDUsername, $liveIDPassword) {

        $deviceCredentials = DeviceIdManager::RegisterDevice();

        // Register Device Credentials and get binaryDAToken
        $deviceCredentialsSoapTemplate = '<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
                 xmlns:a="http://www.w3.org/2005/08/addressing"
                 xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
                <s:Header>
                    <a:Action s:mustUnderstand="1">
                    http://schemas.xmlsoap.org/ws/2005/02/trust/RST/Issue</a:Action>
                    <a:MessageID>urn:uuid:%s</a:MessageID>
                    <a:ReplyTo>
                        <a:Address>http://www.w3.org/2005/08/addressing/anonymous</a:Address>
                    </a:ReplyTo>
                    <a:To s:mustUnderstand="1">
                    https://login.microsoftonline.com/liveidSTS.srf</a:To>
                    <o:Security s:mustUnderstand="1"
                    xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                        <u:Timestamp u:Id="_0">
                        <u:Created>%sZ</u:Created>
                        <u:Expires>%sZ</u:Expires>
                        </u:Timestamp>
                        <o:UsernameToken u:Id="devicesoftware">
                        <o:Username>%s</o:Username>
                        <o:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">%s</o:Password>
                        </o:UsernameToken>
                    </o:Security>
                    </s:Header>
                   <s:Body>
                   <t:RequestSecurityToken xmlns:t="http://schemas.xmlsoap.org/ws/2005/02/trust">
                        <wsp:AppliesTo xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy">
                        <a:EndpointReference>
                            <a:Address>http://passport.net/tb</a:Address>
                        </a:EndpointReference>
                        </wsp:AppliesTo>
                        <t:RequestType>
                        http://schemas.xmlsoap.org/ws/2005/02/trust/Issue</t:RequestType>
                    </t:RequestSecurityToken>
                    </s:Body>
                </s:Envelope>';


        $soapTemplate = sprintf(
                $deviceCredentialsSoapTemplate, LiveIDManager::gen_uuid(), LiveIDManager::getCurrentTime(), LiveIDManager::getNextDayTime(), $deviceCredentials->getDeviceName(), $deviceCredentials->getPassword());

        
        $binaryDATokenXML = LiveIDManager::GetSOAPResponse("/liveidSTS.srf" , "login.microsoftonline.com" , "https://login.microsoftonline.com/liveidSTS.srf", $soapTemplate);
        
        preg_match('/<CipherValue>(.*)<\/CipherValue>/', $binaryDATokenXML, $matches);
	$cipherValue =  $matches[1];


        // Step 3: Get Security Token by sending WLID username, password and device binaryDAToken
        $securityTokenSoapTemplate = '<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
                 xmlns:a="http://www.w3.org/2005/08/addressing"
                 xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
                <s:Header>
                    <a:Action s:mustUnderstand="1">
                    http://schemas.xmlsoap.org/ws/2005/02/trust/RST/Issue</a:Action>
                    <a:MessageID>urn:uuid:%s</a:MessageID>
                    <a:ReplyTo>
                      <a:Address>http://www.w3.org/2005/08/addressing/anonymous</a:Address>
                    </a:ReplyTo>
                    <VsDebuggerCausalityData xmlns="http://schemas.microsoft.com/vstudio/diagnostics/servicemodelsink">
                    uIDPozBEz+P/wJdOhoN2XNauvYcAAAAAK0Y6fOjvMEqbgs9ivCmFPaZlxcAnCJ1GiX+Rpi09nSYACQAA</VsDebuggerCausalityData>
                    <a:To s:mustUnderstand="1">
                    https://login.microsoftonline.com/liveidSTS.srf</a:To>
                    <o:Security s:mustUnderstand="1"
                    xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                      <u:Timestamp u:Id="_0">
                       <u:Created>%s</u:Created>
                       <u:Expires>%s</u:Expires>
                      </u:Timestamp>
                      <o:UsernameToken u:Id="user">
                        <o:Username>%s</o:Username>
                        <o:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">%s</o:Password>
                      </o:UsernameToken>
                      <wsse:BinarySecurityToken ValueType="urn:liveid:device"
                      xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
                        <EncryptedData Id="BinaryDAToken0"
                        Type="http://www.w3.org/2001/04/xmlenc#Element"
                        xmlns="http://www.w3.org/2001/04/xmlenc#">
                          <EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#tripledes-cbc">
                          </EncryptionMethod>
                          <ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                            <ds:KeyName>http://Passport.NET/STS</ds:KeyName>
                          </ds:KeyInfo>
                          <CipherData>
                            <CipherValue>
                              %s"
                            </CipherValue>
                          </CipherData>
                        </EncryptedData>
                      </wsse:BinarySecurityToken>
                    </o:Security>
                 </s:Header>
                  <s:Body>
                    <t:RequestSecurityToken xmlns:t="http://schemas.xmlsoap.org/ws/2005/02/trust">
                      <wsp:AppliesTo xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy">
                        <a:EndpointReference>
                          <a:Address>%s</a:Address>
                        </a:EndpointReference>
                      </wsp:AppliesTo>
                     <wsp:PolicyReference URI="MBI_FED_SSL"
                      xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy" />
                      <t:RequestType>http://schemas.xmlsoap.org/ws/2005/02/trust/Issue</t:RequestType>
                    </t:RequestSecurityToken>
                  </s:Body>
                 </s:Envelope>';

        // Create the URN address of the format urn:crm:dynamics.com.
        // Replace crm with crm4 for Europe & crm5 for Asia.
        $URNAddress = "urn:crmna:dynamics.com";

        if (strpos($CRMUrl,"crm4.dynamics.com")) {
            $URNAddress = "urn:crm4:dynamics.com";
        }

        if (strpos($CRMUrl,"crm5.dynamics.com")) {
            $URNAddress = "urn:crm5:dynamics.com";
        }

        $securityTemplate = sprintf(
                        $securityTokenSoapTemplate, LiveIDManager::gen_uuid(), LiveIDManager::getCurrentTime(), LiveIDManager::getNextDayTime(), $liveIDUsername, $liveIDPassword, $cipherValue, $URNAddress);


        $securityTokenXML = LiveIDManager::GetSOAPResponse("/liveidSTS.srf" , "login.microsoftonline.com" , "https://login.microsoftonline.com/liveidSTS.srf", $securityTemplate);

        
        $responsedom = new DomDocument();
        $responsedom->loadXML($securityTokenXML);
		
        $cipherValues = $responsedom->getElementsbyTagName("CipherValue");

        
        if( isset ($cipherValues) && $cipherValues->length>0
            ){
            $securityToken0 =  $cipherValues->item(0)->textContent;
            $securityToken1 =  $cipherValues->item(1)->textContent;
            $keyIdentifier = $responsedom->getElementsbyTagName("KeyIdentifier")->item(0)->textContent;	
        }else{
            return null;
        }
        $newSecurityData = new SecurityData($keyIdentifier, $securityToken0, $securityToken1);
        return $newSecurityData;
    }

    public static function getCurrentTime() {
        return substr(date('c'), 0, -6) . ".00";
    }

    public static function getNextDayTime() {
        return substr(date('c', strtotime('+1 day')), 0, -6) . ".00";
    }

    public static function gen_uuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public static function GetSOAPResponse($postUrl, $hostname, $soapUrl, $content) {

        // setup headers
        $headers = array(
            "POST " . $postUrl . " HTTP/1.1",
            "Host: " . $hostname,
            'Connection: Keep-Alive',
            "Content-type: application/soap+xml; charset=UTF-8",
            "Content-length: " . strlen($content),
        );

        $cURLHandle = curl_init();
        curl_setopt($cURLHandle, CURLOPT_URL, $soapUrl);
        curl_setopt($cURLHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cURLHandle, CURLOPT_TIMEOUT, 60);
        curl_setopt($cURLHandle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cURLHandle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($cURLHandle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($cURLHandle, CURLOPT_POST, 1);
        curl_setopt($cURLHandle, CURLOPT_POSTFIELDS, $content);
        $response = curl_exec($cURLHandle);
        curl_close($cURLHandle);

        return $response;
    }

}

?>
