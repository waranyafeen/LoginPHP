<?php
session_start();
include_once "config/function.php";

// ถ้าเกิดไม่มี session adminid
if (!isset($_SESSION['adminid'])) {
    // กำหนด location redirect
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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

                <!-- ปุ่ม logout -->
                <div class="d-flex my-2 my-lg-0">
                    <?php if (isset($_SESSION['adminid'])) { ?>
                        <a id="logout" class="btn btn-danger">Logout</a>
                    <?php } else { ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </nav>

    <main class="container">
        <?php

        $adminId = $_SESSION['adminid'];
        $stmt = $con->prepare("SELECT * FROM user WHERE id = :adminid");
        $stmt->bindParam(":adminid", $adminId);
        $stmt->execute();

        $adminData = $stmt->fetch();

        ?>
        <h1>Hello, <?= $adminData['username']; ?></h1>
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

    <!-- logout -->
    <script>
        $(document).ready(function() {
            $("#logout").on("click", function(e) {
                e.preventDefault();

                $.ajax({
                    url: "logout.php",
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            window.location.href = "login.php";
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })

            })
        });
    </script>
</body>

</html>