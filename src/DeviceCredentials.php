<?php

class DeviceCredentials {
    private $deviceName;
    private $password;

    public function DeviceCredentials($deviceName, $password) {
        $this->deviceName = $deviceName;
        $this->password = $password;
    }

    public function getDeviceName() {
        return $this->deviceName;
    }

    public function getPassword() {
        return $this->password;
    }

}

?>
