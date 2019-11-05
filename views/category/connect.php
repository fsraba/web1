<?php
if(empty($_GET['id']) || empty($_GET['password'])){
  echo "<html>";
  echo "<body>";
  echo "<form name='text' action='web1.php' method='get'>";
  echo "<h4>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='id'><br>";
  echo "PASS<input type='password' name='password'><br></h4>";
  echo "<input type='submit' value='Login'>";
  echo "</form>";
  echo "</body>";
  echo "</html>";
}

else{
  $id = $_GET['id'];
  $password = $_GET['password'];

  $mysql_hostname = '127.0.0.1';
  $mysql_username = 'root';
  $mysql_password = '021021';
  $mysql_database = 'ivias';
  $mysql_port = '3306';
  $mysql_charset = 'UTF8';
    
  $connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, $mysql_port, $mysql_charset);

  $sql = mysqli_query("select * from users where id='$id' and password=$password") or die (mysqli_error());

  $row = mysqli_fetch_array($sql);

  if($row[id] && $row[password]){
    echo "<font color=#FF0000><h1>"."Login success"."</h1></u><br>";
    echo "<h3><font color=#000000>"."Hello, "."</u>";
    echo "<font color=#D2691E>".$row[id]."</u></h3><br>";
  }
  else{
    echo "<script>alert('Login failed');</script>";
  }
  mysqli_close($db);
}

?>