<?php 

$host = "localhost";
$dbname = "adminsystem";
$username = "root";
$password = "";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $con = new PDO($dsn, $username, $password);
    
    // กำหนดโหมดจัดการข้อผิดพลาด
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // โหมดกำหนดการดึงข้อมูล
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // ปิดการทำงาน EMULATE_PREPARES
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // echo "Connection successfully";

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>