<?php
// connect
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=easydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>


<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "easydb";
    
    private $dbh;
    private $error;
    
    private $stmt;
    
    public function __construct()
    {
        // Set DSN
        $dsn     = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute()
    {
        return $this->stmt->execute();
    }
    
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
    
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }
    
    public function endTransaction()
    {
        return $this->dbh->commit();
    }
    
    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }
    
    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }
    
    
}

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }
    function current() {
        return "<td>" . parent::current(). "</td>";
    }
    function beginChildren() { 
        echo "<tr>"; 
    } 
    function endChildren() { 
        echo "</tr>" . "\n";
    } 
}




?>

