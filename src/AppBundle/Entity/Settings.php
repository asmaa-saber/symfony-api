<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Settings {

    /**
     * @var string
     */
    private $settingKey;

    /**
     * @var string
     */
    private $settingValue;


    /**
     * Get settingKey
     *
     * @return string 
     */
    public function getSettingKey()
    {
        return $this->settingKey;
    }

    /**
     * Set settingValue
     *
     * @param string $settingValue
     * @return Settings
     */
    public function setSettingValue($settingValue)
    {
        $this->settingValue = $settingValue;

        return $this;
    }

    /**
     * Get settingValue
     *
     * @return string 
     */
    public function getSettingValue()
    {
        return $this->settingValue;
    }
}
