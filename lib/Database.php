<?php
class Database {
    private static $config;

    public $db;
    public $host;
    public $name;
    public $username;
    public $password;
    public $dieOnError;
    public $queries;
    public $result;

    public $redirect = false;

    private function __construct($connect = false) {
        $config = Config::getConfig();

        $this->host       = $config->dbHost;
        $this->name       = $config->dbName;
        $this->username   = $config->dbUsername;
        $this->password   = $config->dbPassword;
        $this->dieOnError = $config->dbDieOnError;

        $this->db = false;
        $this->queries = array();

        if($connect === true) {
            $this->connect();
        }
    }

    public static function getDatabase($connect = true) {
        if(is_null(self::$config)) {
            self::$config = new Database($connect);
        }
        return self::$config;
    }

    public function isConnected() {
        return is_object($this->db);
    }

    public function databaseSelected() {
        if(!$this->isConnected()) return false;
		$result = mysqli_query($this->db, "SHOW TABLES");
        return is_object($result);
    }

    public function connect() {
		$this->db = mysqli_connect($this->host, $this->username, $this->password, $this->name) or $this->notify();
        if($this->db === false) return false;
        return $this->isConnected();
    }

    public function query($sql, $args_to_prepare = null, $exception_on_missing_args = true) {
        if(!$this->isConnected()) $this->connect();

        if(is_array($args_to_prepare)) {
            foreach($args_to_prepare as $name => $val) {
                $val = $this->quote($val);
                $sql = str_replace(":$name:", $val, $sql, $count);
                if($exception_on_missing_args && (0 == $count)) {
                    throw new Exception(":$name: was not found in prepared SQL query.");
                }
            }
        }

        $this->queries[] = $sql;
        $this->result = mysqli_query($this->db, $sql) or $this->notify();
        return $this->result;
    }

    public function numRows($arg = null) {
        $result = $this->resulter($arg);
        return ($result !== false) ? mysqli_num_rows($result) : false;
    }

    public function hasRows($arg = null) {
        $result = $this->resulter($arg);
        return is_object($result) && (mysqli_num_rows($result) > 0);
    }

    public function affectedRows() {
        if(!$this->isConnected()) return false;
        return mysqli_affected_rows($this->db);
    }

    public function insertId() {
        if(!$this->isConnected()) return false;
        $id = mysqli_insert_id($this->db);
        if($id === 0 || $id === false) {
            return false;
        }
        else {
            return $id;
        }
    }

    public function getValue($arg = null) {
        $result = $this->resulter($arg);
		if($this->hasRows($result)) {
			$row = mysqli_fetch_row($result);
			return $row[0];
		}
		else {
			return false;
		}
    }

    public function getValues($arg = null) {
        $result = $this->resulter($arg);
        if(!$this->hasRows($result)) return array();

        $values = array();
        mysqli_data_seek($result, 0);
        while($row = mysqli_fetch_row($result)) {
            $values[] = array_pop($row);
        }
        return $values;
    }

    public function getRow($arg = null) {
        $result = $this->resulter($arg);
        return $this->hasRows() ? mysqli_fetch_array($result, MYSQLI_ASSOC) : false;
    }

    public function getRows($arg = null) {
        $result = $this->resulter($arg);
        if(!$this->hasRows($result)) return array();

        $rows = array();
        mysqli_data_seek($result, 0);
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function quote($var) {
        if(!$this->isConnected()) $this->connect();
        return "'" . $this->escape($var) . "'";
    }

    public function escape($var) {
        if(!$this->isConnected()) $this->connect();
        return mysqli_real_escape_string($this->db, $var);
    }

    public function numQueries() {
        return count($this->queries);
    }

    public function lastQuery() {
        if($this->numQueries() > 0) {
            return $this->queries[$this->numQueries() - 1];
        }
        else {
            return false;
        }
    }

    private function notify() {
        $err_msg = mysqli_error($this->db);
        error_log($err_msg);

        if($this->dieOnError === true) {
            echo "<p style='border:5px solid red;background-color:#fff;padding:5px;'><strong>Database Error:</strong><br/>$err_msg</p>";
            echo "<p style='border:5px solid red;background-color:#fff;padding:5px;'><strong>Last Query:</strong><br/>" . $this->lastQuery() . "</p>";
            echo "<pre>";
            debug_print_backtrace();
            echo "</pre>";
            exit;
        }

        if(is_string($this->redirect)) {
            header("Location: {$this->redirect}");
            exit;
        }
    }

    private function resulter($arg = null) {
        if(is_null($arg) && is_object($this->result)) {
            return $this->result;
        }
        elseif(is_object($arg)) {
            return $arg;
        }
        elseif(is_string($arg)) {
            $this->query($arg);
            if(is_object($this->result)) {
                return $this->result;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}
?>