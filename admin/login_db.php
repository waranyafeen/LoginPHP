<?php
// รับค่าจาก frontend ที่ส่งมา
session_start();
include_once "config/function.php";

// ถ้ามีการส่ง post request มา
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // จะเก็บค่าที่ส่งมาแบบ method post
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ใช้ prepare ฟังก์ชันในการดึงข้อมูลมา 
    // ดึงตัวแปร con จาก function.php มา
    $stmt = $con->prepare("SELECT * FROM user WHERE username = :username");
    // ผูกค่าด้วย method by_param
    $stmt->bindParam(":username", $username);
    // run ดัวย method execute
    $stmt->execute();

    // fetch ข้อมูลของ user มา
    $user = $stmt->fetch();

    // check ถ้ามีข้อมูล user and password กรอกเข้ามาที่ตรงในระบบ
    // ด้วย password_verify(ข้อมูลกรอกเข้ามา, ข้อมูลในระบบ)
    if ($user && password_verify($password, $user["password"])) {
        // สร้าง session ขึ้นมาเก็บ id ชื่อว่า adminid และ ดึงค่ามาจาก uesr
        $_SESSION["adminid"] = $user["id"];

        echo json_encode([
            "status" => "success",
            "message" => "Login successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid username or password"
        ]);
    }
}
