<?php
$servername = "localhost";
$username = "root";
$password = "12345"; 
$dbname = "bannoithat_db";
$port = 3307; 

$con = new mysqli($servername, $username, $password, $dbname, $port);

if ($con->connect_error) {
    die("Lỗi kết nối CSDL: " . $con->connect_error);
}
// else {
//     echo "Kết nối thành công";
// }
?>
