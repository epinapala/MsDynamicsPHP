<?php

class SecurityData {

    public function SecurityData($keyIdentifier, $securityToken0, $securityToken1) {
        $this->keyIdentifier = $keyIdentifier;
        $this->securityToken0 = $securityToken0;
        $this->securityToken1 = $securityToken1;
    }
    private $keyIdentifier;
    private $securityToken0;
    private $securityToken1;

    public function getKeyIdentifier() {
        return $this->keyIdentifier;
    }

    public function getSecurityToken0() {
        return $this->securityToken0;
    }

    public function getSecurityToken1() {
        return $this->securityToken1;
    }
    
}

?>
