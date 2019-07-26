<?php
   if(isset($_POST['submit'])) {
 
   $user = $_POST['user'];
   $pass = $_POST['pass'];
   $mat = $_POST['mat'];
   $action = $_POST['action'];

   $server = "localhost";
  
   // Constructor

   function __constructor($server, $user, $pass, $mat, $action) {
      $this->server = $server;
      $this->user = $user;
      $this->pass = $pass;
      $this->mat = $mat;
      $this->action = $action;
   }
/*
   header('Content-Type: application/json');
   $site = curl_init("http://localhost/WEBAPPS/ex.html");
   curl_setopt($site, CURLOPT_RETURNTRANSFER, true);
   $target = curl_exec($site);

   $dom = new DOMDocument();
   @$dom -> loadHTML($target);
*/
   // Create connection
/*
      $conn = new mysqli($servername, $username, $password);
  
   // Check connection

   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
*/
   // Check da cambiare(es: header richiamabile)

   $hostname = "localhost"; 
   $username = "root"; 
   $password = "";
   $nome_database = "Anonymous";

   $conn = mysqli_connect('localhost','root','','Anonymous');  
   if(!$conn){ 
       die("Errore di connessione: ".mysql_error());
   }

//   $conn = mysqli($hostname,$username,$password,$nome_database); 
/*
   $seleziona_db = mysql_select_db($nome_database,$conn); 
   if(!$seleziona_db) { 
       die("Errore di selezione database".mysql_error()); 
   }
*/
   // Query
       
      //$sq = "INSERT INTO Docenti (nome, cognome, matricola) VALUES ('$user', '$pass', '$mat')";
      //$res = mysqli_query($conn, $sq);
   } else {
      header('Content-Type: application/json');

   $site = curl_init("http://localhost/WEBAPPS/index.html");
   curl_setopt($site, CURLOPT_RETURNTRANSFER, true);
   $target = curl_exec($site);

   $dom = new DOMDocument();
   @$dom -> loadHTML($target);

   // Create connection
/*
      $conn = new mysqli($servername, $username, $password);
  
   // Check connection

   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
*/
   // Check da cambiare(es: header richiamabile)

   $hostname = "localhost"; 
   $username = "root"; 
   $password = "";
   $nome_database = "Anonymous";

   $conn = mysqli_connect('localhost','root','','Anonymous');  
   if(!$conn){ 
       die("Errore di connessione: ".mysql_error());
   }
   
      $sql = "SELECT * FROM Docenti";
      $result = $conn->query($sql);

      $col = 0;
   
      $deep = $result->num_rows;

      if ($result->num_rows > 0) {
      // output data of each row
        echo "[";
        while($row = $result->fetch_assoc()) {
         $nome = $row["nome"];
         $cognome = $row["cognome"];
         $matricola = $row["matricola"];

         $arr = array('no' => $nome, 'co' => $cognome, 'ma' => $matricola);
         
         echo json_encode($arr);
          
         if($col < ($deep - 1)) { echo ","; }
          
         $col = $col + 1;
      }
   } else {
      echo "0 results";
   }

   echo "]";
   }

   $conn->set_charset("utf8");

   $conn->close();   
    
/*
   $sql = "SELECT * FROM Aule";
   $result = $conn->query($sql);

   $col = 0;

   if ($result->num_rows > 0) {
    // output data of each row
      echo "[";
      while($row = $result->fetch_assoc()) {
         $aula = $row["aula"];
         $dispo = $row["disponibilita"];
         
         $arr = array('a' => $aula, 'd' => $dispo);
         
         echo json_encode($arr);
          
         if($col == 0) { echo ","; }
          
         $col = $col + 1;
      }
   } else {
      echo "0 results";
   }

   echo"]";
*/
   // Language support

?>