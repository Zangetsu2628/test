<?php
    class Config {
        private static $config;

        private $productionServer = '';
        private $developmentServer = 'yourdomain.com';

        // Database Class
        public $dbHost;
        public $dbName;
        public $dbUsername;
        public $dbPassword;
        public $dbDieOnError;

        private function __construct() {
            $environment = $this->checkEnvironment();

            if($environment == 'production') {
                $this->production();
            }
            elseif($environment == 'development') {
                $this->development();
            }
            else {
                die('Fail to configure servers in config');
            }
        }

        public static function getConfig() {
            if(is_null(self::$config)) {
                self::$config = new Config();
            }
            return self::$config;
        }

        public static function get($key) {
            return self::$config->$key;
        }

        // Add code to run only on production server
        private function production() {
            ini_set('display_errors', '0');
            ini_set('error_reporting', 0);
            define('AUTOLOADER_LIB_PATH', '../lib/');
            define('AUTOLOADER_APP_PATH', '../app/controller/');
            define('DEFAULT_CONTROLLER', 'home');
            define('DEFAULT_ACTION', 'indexAction');
            define('DEFAULT_ERROR', 'ErrorController');
            define('LAYOUT_PATH', '../app/view/layout/');
            define('VIEW_PATH', '../app/view/view/');

            $this->dbHost = 'localhost';
            $this->dbName = 'Test';
            $this->dbUsername  = 'user';
            $this->dbPassword  = 'passwd';
            $this->dbDieOnError = false;
        }

        // Add code to run only on dev server
        private function development() {
            ini_set('display_errors', '1');
            ini_set('error_reporting', E_ALL);
            define('AUTOLOADER_LIB_PATH', '../lib/');
            define('AUTOLOADER_APP_PATH', '../app/controller/');
            define('DEFAULT_CONTROLLER', 'home');
            define('DEFAULT_ACTION', 'indexAction');
            define('DEFAULT_ERROR', 'ErrorController');
            define('LAYOUT_PATH', '../app/view/layout/');
            define('VIEW_PATH', '../app/view/view/');

            $this->dbHost = 'localhost';
            $this->dbName = 'Test';
            $this->dbUsername = 'user';
            $this->dbPassword = 'passwd';
            $this->dbDieOnError = true;
        }

        public function checkEnvironment() {
            if($this->productionServer == getenv('HTTP_HOST')) {
                return 'production';
            }
            else if($this->developmentServer == getenv('HTTP_HOST')) {
                return 'development';
            }

            return false;
        }
    }
?>