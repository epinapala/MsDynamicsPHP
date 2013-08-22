<?php

include_once ("DeviceCredentials.php");
include_once ("LiveIdConstants.php");

class DeviceIdManager {

    public static function RegisterDevice() {
        //Create the credentials
        
        $credentials = DeviceIdManager::GenerateCredentials();

        $v_createregistrationenvelope = DeviceIdManager::CreateRegistrationEnvelope(
                            $credentials->getDeviceName(),
                            $credentials->getPassword()
                    );
        
        $puid = DeviceIdManager::ExecuteRegistrationRequest('/DeviceAddCredential.srf',
                                                            'login.microsoftonline.com',
                                                            LiveIdConstants::$RegistrationEndpointUri,
                                                            $v_createregistrationenvelope);
        
        return $credentials;
    }

    public static function GenerateCredentials() {
        date_default_timezone_set('UTC');
	$currentTime = strval(time());
	$deviceUserName = $currentTime . "2u91rlobl7lvkihb";
	$devicePassword = "GRB+WGz`eCkr-k" . $currentTime;
        return new DeviceCredentials($deviceUserName, $devicePassword);
    }

    public static function CreateRegistrationEnvelope($deviceName, $password) {
        //The format of the envelope is the following:
        //<DeviceAddRequest>
        //  <ClientInfo name="[app GUID]" version="1.0"/>
        //  <Authentication>
        //    <Membername>[prefix][device name]</Membername>
        //    <Password>[device password]</Password>
        //  </Authentication>
        //</DeviceAddRequest>

        //Instantiate the writer and write the envelope
        $registrationEndpointUri = "https://login.microsoftonline.com/ppsecure/DeviceAddCredential.srf";

	$registrationEnvelope = '
			<DeviceAddRequest>
			  <ClientInfo name="8758DD28-6EBD-DF11-855A-78E7D1623F35" version="1.0"/>
			  <Authentication>
			    <Membername>'.$deviceName.'</Membername>
			    <Password>'.$password.'</Password>
			  </Authentication>
			</DeviceAddRequest>';

        return $registrationEnvelope;
    }


    public static function ExecuteRegistrationRequest($postUrl, $hostname, $soapUrl, $content){
       
	// setup headers
        $headers = array(
                        "POST ". $postUrl ." HTTP/1.1",
                        "Host: " . $hostname,
                        'Connection: Keep-Alive',
                        "Content-type: application/soap+xml; charset=UTF-8",
                        "Content-length: ".strlen($content),
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
