<?php
include_once "config/function.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/custom.css">

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <nav
        class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Home
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="dropdownId"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">Dropdown</a>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <input
                        class="form-control me-sm-2"
                        type="text"
                        placeholder="Search" />
                    <button
                        class="btn btn-outline-success my-2 my-sm-0"
                        type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">
        <form id="loginform" action="">
            <h3>Admin Login</h3>
            <div id="result"></div>
            <input type="text" id="username" class="mt-3 form-control" placeholder="username">
            <input type="password" id="password" class="mt-3 form-control" placeholder="password">
            <button type="submit" class="mt-3 btn btn-primary">Login</button>
        </form>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <!-- 1.copy link jQery -->
    <script src="https://code.jquery.com/jquery-4.0.0.js"></script>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

    <!-- 2. -->
    <script>
        $(document).ready(function() {
            $("#loginform").on("submit", function(e) {
                e.preventDefault(); //ป้องกันหน้าเว็บรีเฟซ

                // เข้าถึงค่าที่ input ด้วย jQuery: id ใช้ method val() เอาค่าที่พิมจาก input มาเก็บไว้ที่ตัวแปร username
                let username = $("#username").val();
                let password = $("#password").val();

                // ส่ง ajax request ไปที่ server
                $.ajax({
                    url: "login_db.php",
                    type: "POST",
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            window.location.href = "index.php";
                            // $("#result").html('<p style="color: green;">' + response.message + '</p>');
                        } else {
                            $("#result").html('<p style="color: red;">' + response.message + '</p>');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $("#result").html('<p style="color: red;">An error occurred. Please try again.</p>');
                    }
                })
            })
        })
    </script>
</body>

</html>