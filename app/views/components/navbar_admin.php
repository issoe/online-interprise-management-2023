<?php
session_start();
?>

<!-- <div style="background-color: #ccc;"> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=home">Home</a> -->
    <?php
    // echo '<a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=' . $_SESSION['loginBtn'] . '">' . $_SESSION['loginBtn'] . '</a>';
    ?>
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=logout">Logout</a> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=dashboard">Dashboard page</a> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=task">List tasks</a> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=admin">Admin page</a> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=department">Department header page</a> -->
    <!-- <a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=employee">Employee page</a> -->
    <!-- <div style="border: 1px solid black; display: inline-block" class="which-user"><?php echo 'Welcome: ' . $_SESSION['username'] . ', userId: ' . $_SESSION['current_user_id'] ?></div> -->
    <!-- <div style="border: 1px solid black; display: inline-block" class="which-user"><?php echo 'You are choosing: ' . $_SESSION["employee_current_id"] ?></div> -->
<!-- </div> -->


<header class="p-1 bg-dark">
    <div class="container-nab">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <a href="http://localhost:8888/Assignment/index.php?page=home" class="nav-link px-2 text-white"><i class="bi bi-house"></i> Home</a>
                <a href="http://localhost:8888/Assignment/index.php?page=admin" class="nav-link px-2 text-white"><i class="bi bi-house"></i> Admin page</a>
            </ul>

            <div class="mr-4">
                <!-- Information after signing in -->
                <div style="display: inline-block;">
                    <span style="color: white">Welcome back,</span>
                    <span id="name" style="color: yellow;"> <?php echo $_SESSION['username']; ?> <span>
                </div>
                <div class="dropdown">
                    <a href="http://localhost:8888/Assignment/index.php?page=Logout">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</header>