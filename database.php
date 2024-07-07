<?php
class DataBase{
static private $db_host="localhost";
static private $db_user="sazjdzdw_10kz21";
static private $db_pass="1001Aa494";
static private $db_database="sazjdzdw_stucomblog";


private $con;
private $result;
private $numRows;

//Conectar a la base de datos
public function __construct(){
$this->con = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_database);
}
//Desconectar de la base de datos
public function disconnect(){
$this->con->close();
}
//Ejecutar las querys -- Solo para selects
public function executer($sql){
$this->result = $this->con->query($sql);
$this->numRows = $this->con->affected_rows;
}
public function getNumRows(){
return $this->numRows;
}
public function getResultados(){
$filas = array();
for($i=0;$i<$this->numRows;$i++){
$filas[] = $this->result->fetch_array();
}
return $filas;
}
}
?>