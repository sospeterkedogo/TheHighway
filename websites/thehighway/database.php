<?php
$host = getenv('DB_HOST') ?: 'mysql';         // Render DB host or local default
$dbname = getenv('DB_NAME') ?: 'thehighway';  // Render DB name or local default
$username = getenv('DB_USER') ?: 'root';      // Render DB user or local default
$password = getenv('DB_PASS') ?: 'v.je';      // Render DB password or local default
$charset = getenv('DB_CHARSET') ?: 'utf8';    // Default charset

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}



class DataBaseTable {
    private $table;
    private $pdo;
    private $primaryKey;

    public function __construct($pdo, $table, $primaryKey) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    //insert into tables
    function insert($record) {
        $keys = array_keys($record);

        $values = implode(', ', $keys);
        $valueswithcolon = implode(', :', $keys);

        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valueswithcolon . ')';

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
    }

    // update values in tables
    function update($record) {

        $query = 'UPDATE ' . $this->table . ' SET ';

        $parameters = [];
        foreach($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }

        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

        $record['primaryKey'] = $record[$this->primaryKey];

        $stmt = $this->pdo->prepare($query);

        $stmt->execute($record);
    }

    // insert into / update any record in any table
    function save($record){
        if (empty($record[$this->primaryKey])){
            unset($record[$this->primaryKey]);
        }
        try {
            $this->insert($record);
        }
        catch (Exception $e) {
            $this->update($record);
        }
    }

    // find a record from any table by any criteria
    function find($field, $value){
        $stmt = $this->pdo->prepare('SELECT * FROM ' .$this->table. ' WHERE ' .$field. '=:value');
        $values = ['value' => $value];
        $stmt->execute($values);
        return $stmt->fetch();
    }

    // find all records from any table by any criteria
    function findAllFrom($field, $value){
        $stmt = $this->pdo->prepare('SELECT * FROM ' .$this->table. ' WHERE ' .$field. '=:value');
        $values = ['value' => $value];
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    // find records from any table
    function findAll(){
        $stmt = $this->pdo->prepare('SELECT * FROM ' .$this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // delete a record from any table by any criteria
    function delete($field, $value){
        $stmt = $this->pdo->prepare('DELETE  FROM ' .$this->table. ' WHERE ' .$field. '=:value');
        $values = ['value' => $value];
        $stmt->execute($values);
    }

    function loadTemplate($filename, $templateVars) {
        extract($templateVars);
        ob_start();
        require $filename;
        $output = ob_get_clean();
        return $output;
    }
}