<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class mymodule extends CModule
{
    var $MODULE_ID = "mymodule";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    function __construct()
    {
        $arModuleVersion = array();

        include(dirname(__FILE__) . "/version.php");

        $this->MODULE_NAME = Loc::getMessage("MYMODULE_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("MYMODULE_MODULE_DESCRIPTION");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = Loc::getMessage("MYMODULE_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("MYMODULE_PARTNER_URI");
    }

    function InstallDB()
    {
        RegisterModule($this->MODULE_ID);
        return true;
    }

    function UnInstallDB()
    {
        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"] . "/local/modules/" . $this->MODULE_ID . "/install/components",
            $_SERVER["DOCUMENT_ROOT"] . "/local/components",
            true,
            true
        );

        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFilesEx("/local/components/mymodule/");

        return true;
    }

    function DoInstall()
    {
        global $APPLICATION;
        $this->InstallDB();
        $this->InstallFiles();
        ModuleManager::registerModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("MYMODULE_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/local/modules/" . $this->MODULE_ID . "/install/step.php"
        );
    }

    function DoUninstall()
    {
        global $APPLICATION;
        $this->UnInstallDB();
        $this->UnInstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("MYMODULE_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"] . "/local/modules/" . $this->MODULE_ID . "/install/unstep.php"
        );
    }
}