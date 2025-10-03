<?php
use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;

class test_currencyrates extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_ID = 'test.currencyrates';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = 'Курсы валют (test.currencyrates)';
        $this->MODULE_DESCRIPTION = 'Сущность курсов валют + фильтр и список (D7).';
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallDB();
        $this->InstallFiles();
    }

    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallDB()
    {
        $connection = Application::getConnection();

        if (!$connection->isTableExists('test_currencyrates')) {
            // Создаём таблицу SQL-ом (как в примере у iblock)
            $connection->queryExecute("
                CREATE TABLE test_currencyrates (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    CODE VARCHAR(3) NOT NULL,
                    DATE DATETIME NOT NULL,
                    COURSE DOUBLE NOT NULL,
                    INDEX IX_TCR_CODE_DATE (CODE, DATE)
                )
            ");
        }
        return true;
    }

    public function UnInstallDB()
    {
        $connection = Application::getConnection();
        if ($connection->isTableExists('test_currencyrates')) {
            $connection->queryExecute("DROP TABLE test_currencyrates");
        }
        return true;
    }

    public function InstallFiles()
    {
        // Копируем компоненты в local/components
        CopyDirFiles(
            __DIR__ . '/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components',
            true, // rewrite
            true  // recursive
        );
        return true;
    }

    public function UnInstallFiles()
    {
        // Удаляем компоненты
        DeleteDirFilesEx('/local/components/test/currencyrates.filter');
        DeleteDirFilesEx('/local/components/test/currencyrates.list');
        return true;
    }
}
