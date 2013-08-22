<?php

class EntityUtils {

    public static function getCRMSoapHeader($CRMURL,$securityData){
        date_default_timezone_set('UTC');
        $soapHeader = '
			<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
			xmlns:a="http://www.w3.org/2005/08/addressing"
			xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
			  <s:Header>
				<a:Action s:mustUnderstand="1">
				http://schemas.microsoft.com/xrm/2011/Contracts/Services/IOrganizationService/Execute</a:Action>
				<a:MessageID>
				urn:uuid:'.LiveIDManager::gen_uuid().'</a:MessageID>
				<a:ReplyTo>
				  <a:Address>
				  http://www.w3.org/2005/08/addressing/anonymous</a:Address>
				</a:ReplyTo>
				<VsDebuggerCausalityData xmlns="http://schemas.microsoft.com/vstudio/diagnostics/servicemodelsink">
				uIDPozJEz+P/wJdOhoN2XNauvYcAAAAAK0Y6fOjvMEqbgs9ivCmFPaZlxcAnCJ1GiX+Rpi09nSYACQAA</VsDebuggerCausalityData>
				<a:To s:mustUnderstand="1">
				'.$CRMURL.'</a:To>
				<o:Security s:mustUnderstand="1"
				xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
				  <u:Timestamp u:Id="_0">
					<u:Created>'.  LiveIDManager::getCurrentTime().'Z</u:Created>
					<u:Expires>'.LiveIDManager::getNextDayTime().'Z</u:Expires>
				  </u:Timestamp>
				  <EncryptedData Id="Assertion0"
				  Type="http://www.w3.org/2001/04/xmlenc#Element"
				  xmlns="http://www.w3.org/2001/04/xmlenc#">
					<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#tripledes-cbc">
					</EncryptionMethod>
					<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
					  <EncryptedKey>
						<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p">
						</EncryptionMethod>
						<ds:KeyInfo Id="keyinfo">
						  <wsse:SecurityTokenReference xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
	
							<wsse:KeyIdentifier EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary"
							ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509SubjectKeyIdentifier">
							'.$securityData->getKeyIdentifier().'</wsse:KeyIdentifier>
						  </wsse:SecurityTokenReference>
						</ds:KeyInfo>
						<CipherData>
						  <CipherValue>
						  '.$securityData->getSecurityToken0().'</CipherValue>
						</CipherData>
					  </EncryptedKey>
					</ds:KeyInfo>
					<CipherData>
					  <CipherValue>
					  '.$securityData->getSecurityToken1().'</CipherValue>
					</CipherData>
				  </EncryptedData>
				</o:Security>
			  </s:Header>';

        

        return $soapHeader;
    }

    public static function getCreateCRMSoapHeader($CRMURL,$securityData){
        date_default_timezone_set('UTC');
        $soapHeader = '
			<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
			xmlns:a="http://www.w3.org/2005/08/addressing"
			xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
			  <s:Header>
				<a:Action s:mustUnderstand="1">
				http://schemas.microsoft.com/xrm/2011/Contracts/Services/IOrganizationService/Create</a:Action>
				<a:MessageID>
				urn:uuid:'.LiveIDManager::gen_uuid().'</a:MessageID>
				<a:ReplyTo>
				  <a:Address>
				  http://www.w3.org/2005/08/addressing/anonymous</a:Address>
				</a:ReplyTo>
				<VsDebuggerCausalityData xmlns="http://schemas.microsoft.com/vstudio/diagnostics/servicemodelsink">
				uIDPozJEz+P/wJdOhoN2XNauvYcAAAAAK0Y6fOjvMEqbgs9ivCmFPaZlxcAnCJ1GiX+Rpi09nSYACQAA</VsDebuggerCausalityData>
				<a:To s:mustUnderstand="1">
				'.$CRMURL.'</a:To>
				<o:Security s:mustUnderstand="1"
				xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
				  <u:Timestamp u:Id="_0">
					<u:Created>'.  LiveIDManager::getCurrentTime().'Z</u:Created>
					<u:Expires>'.LiveIDManager::getNextDayTime().'Z</u:Expires>
				  </u:Timestamp>
				  <EncryptedData Id="Assertion0"
				  Type="http://www.w3.org/2001/04/xmlenc#Element"
				  xmlns="http://www.w3.org/2001/04/xmlenc#">
					<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#tripledes-cbc">
					</EncryptionMethod>
					<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
					  <EncryptedKey>
						<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p">
						</EncryptionMethod>
						<ds:KeyInfo Id="keyinfo">
						  <wsse:SecurityTokenReference xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
	
							<wsse:KeyIdentifier EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary"
							ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509SubjectKeyIdentifier">
							'.$securityData->getKeyIdentifier().'</wsse:KeyIdentifier>
						  </wsse:SecurityTokenReference>
						</ds:KeyInfo>
						<CipherData>
						  <CipherValue>
						  '.$securityData->getSecurityToken0().'</CipherValue>
						</CipherData>
					  </EncryptedKey>
					</ds:KeyInfo>
					<CipherData>
					  <CipherValue>
					  '.$securityData->getSecurityToken1().'</CipherValue>
					</CipherData>
				  </EncryptedData>
				</o:Security>
			  </s:Header>';

        

        return $soapHeader;
    }

      public static function getUpdateCRMSoapHeader($CRMURL,$securityData){
        date_default_timezone_set('UTC');
        $soapHeader = '
			<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
			xmlns:a="http://www.w3.org/2005/08/addressing"
			xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
			  <s:Header>
				<a:Action s:mustUnderstand="1">
				http://schemas.microsoft.com/xrm/2011/Contracts/Services/IOrganizationService/Update</a:Action>
				<a:MessageID>
				urn:uuid:'.LiveIDManager::gen_uuid().'</a:MessageID>
				<a:ReplyTo>
				  <a:Address>
				  http://www.w3.org/2005/08/addressing/anonymous</a:Address>
				</a:ReplyTo>
				<VsDebuggerCausalityData xmlns="http://schemas.microsoft.com/vstudio/diagnostics/servicemodelsink">
				uIDPozJEz+P/wJdOhoN2XNauvYcAAAAAK0Y6fOjvMEqbgs9ivCmFPaZlxcAnCJ1GiX+Rpi09nSYACQAA</VsDebuggerCausalityData>
				<a:To s:mustUnderstand="1">
				'.$CRMURL.'</a:To>
				<o:Security s:mustUnderstand="1"
				xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
				  <u:Timestamp u:Id="_0">
					<u:Created>'.  LiveIDManager::getCurrentTime().'Z</u:Created>
					<u:Expires>'.LiveIDManager::getNextDayTime().'Z</u:Expires>
				  </u:Timestamp>
				  <EncryptedData Id="Assertion0"
				  Type="http://www.w3.org/2001/04/xmlenc#Element"
				  xmlns="http://www.w3.org/2001/04/xmlenc#">
					<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#tripledes-cbc">
					</EncryptionMethod>
					<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
					  <EncryptedKey>
						<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p">
						</EncryptionMethod>
						<ds:KeyInfo Id="keyinfo">
						  <wsse:SecurityTokenReference xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
	
							<wsse:KeyIdentifier EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary"
							ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509SubjectKeyIdentifier">
							'.$securityData->getKeyIdentifier().'</wsse:KeyIdentifier>
						  </wsse:SecurityTokenReference>
						</ds:KeyInfo>
						<CipherData>
						  <CipherValue>
						  '.$securityData->getSecurityToken0().'</CipherValue>
						</CipherData>
					  </EncryptedKey>
					</ds:KeyInfo>
					<CipherData>
					  <CipherValue>
					  '.$securityData->getSecurityToken1().'</CipherValue>
					</CipherData>
				  </EncryptedData>
				</o:Security>
			  </s:Header>';

        

        return $soapHeader;
    }

      public static function getDeleteCRMSoapHeader($CRMURL,$securityData){
        date_default_timezone_set('UTC');
        $soapHeader = '
			<s:Envelope xmlns:s="http://www.w3.org/2003/05/soap-envelope"
			xmlns:a="http://www.w3.org/2005/08/addressing"
			xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
			  <s:Header>
				<a:Action s:mustUnderstand="1">
				http://schemas.microsoft.com/xrm/2011/Contracts/Services/IOrganizationService/Delete</a:Action>
				<a:MessageID>
				urn:uuid:'.LiveIDManager::gen_uuid().'</a:MessageID>
				<a:ReplyTo>
				  <a:Address>
				  http://www.w3.org/2005/08/addressing/anonymous</a:Address>
				</a:ReplyTo>
				<VsDebuggerCausalityData xmlns="http://schemas.microsoft.com/vstudio/diagnostics/servicemodelsink">
				uIDPozJEz+P/wJdOhoN2XNauvYcAAAAAK0Y6fOjvMEqbgs9ivCmFPaZlxcAnCJ1GiX+Rpi09nSYACQAA</VsDebuggerCausalityData>
				<a:To s:mustUnderstand="1">
				'.$CRMURL.'</a:To>
				<o:Security s:mustUnderstand="1"
				xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
				  <u:Timestamp u:Id="_0">
					<u:Created>'.  LiveIDManager::getCurrentTime().'Z</u:Created>
					<u:Expires>'.LiveIDManager::getNextDayTime().'Z</u:Expires>
				  </u:Timestamp>
				  <EncryptedData Id="Assertion0"
				  Type="http://www.w3.org/2001/04/xmlenc#Element"
				  xmlns="http://www.w3.org/2001/04/xmlenc#">
					<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#tripledes-cbc">
					</EncryptionMethod>
					<ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
					  <EncryptedKey>
						<EncryptionMethod Algorithm="http://www.w3.org/2001/04/xmlenc#rsa-oaep-mgf1p">
						</EncryptionMethod>
						<ds:KeyInfo Id="keyinfo">
						  <wsse:SecurityTokenReference xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
	
							<wsse:KeyIdentifier EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary"
							ValueType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-x509-token-profile-1.0#X509SubjectKeyIdentifier">
							'.$securityData->getKeyIdentifier().'</wsse:KeyIdentifier>
						  </wsse:SecurityTokenReference>
						</ds:KeyInfo>
						<CipherData>
						  <CipherValue>
						  '.$securityData->getSecurityToken0().'</CipherValue>
						</CipherData>
					  </EncryptedKey>
					</ds:KeyInfo>
					<CipherData>
					  <CipherValue>
					  '.$securityData->getSecurityToken1().'</CipherValue>
					</CipherData>
				  </EncryptedData>
				</o:Security>
			  </s:Header>';

        

        return $soapHeader;
    }

    
}

?>
