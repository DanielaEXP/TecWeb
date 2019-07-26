<?php

   header('Content-Type: application/json');

   $site = curl_init("http://localhost/WEBAPPS/ex.html");
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

//   $conn = mysqli($hostname,$username,$password,$nome_database); 
/*
   $seleziona_db = mysql_select_db($nome_database,$conn); 
   if(!$seleziona_db) { 
       die("Errore di selezione database".mysql_error()); 
   }
*/
   // Query
/*
      $sq = "INSERT INTO Docenti (nome, cognome, matricola) VALUES ('$user', '$pass', '$mat')";
      $res = mysqli_query($conn, $sq);
   }
*/
   $sql = "SELECT * FROM Aule";
   $result = $conn->query($sql);

   $col = 0;
   
   $deep = $result->num_rows;

   if ($result->num_rows > 0) {
    // output data of each row
      echo "[";
      while($row = $result->fetch_assoc()) {
         $aula = $row["aula"];
         $dispo = $row["disponibilita"];
         $lez = $row["lezione"];
         $doc = $row["docente"];
         $ora = $row["orario"];
         $pos = $row["posti"];
         $pia = $row["piano"];
         
         $arr = array('au' => $aula, 'di' => $dispo, 'le' => $lez, 'do' => $doc, 'or' => $ora, 'po' => $pos, 'pi' => $pia);
         
         echo json_encode($arr);
          
         if($col < ($deep - 1)) { echo ","; }
          
         $col = $col + 1;
      }
   } else {
      echo "0 results";
   }

   echo "]";

   // Language support

   $conn->set_charset("utf8");

   $conn->close();

?>