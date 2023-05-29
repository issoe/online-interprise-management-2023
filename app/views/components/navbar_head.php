<?php
session_start();
?>

<header class="p-1 mb-3 bg-dark">
    <div class="container-nab">
        <div class="d-flex">
            <div class="p-2">
                <a href="http://localhost:8888/Assignment/index.php?page=home" class="nav-link px-2 text-white"><i class="bi bi-house"></i> Home</a>
            </div>
            <div class="p-2">
                <li style="padding-left: 10px;" class="dropdown">
                    <a href="#" class="nav-link px-2 text-white"><i class="fa fa-info" aria-hidden="true"></i> Your information</a>
                    <div class="dropdown-content">
                        <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i> Department:
                            <span style="color: red;">
                                <?php echo $_SESSION['department_name']; ?>
                                <span>
                        </a>
                        <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Level: <span id="name" style="color: red;">Department Head<span></a>
                    </div>
                </li>
            </div>

            <div class="ml-auto p-2">
                <div class="text-end">
                    <!-- Information after signing in -->
                    <a style="padding-right: 5px;"><span style="color: white">Welcome back,</span>
                        <span id="name" style="color: yellow;">
                            <?php echo $_SESSION['username']; ?>
                            <span>
                    </a>
                </div>
            </div>
            <div class="p-2">
            <div class="dropdown">
                        <a href="http://localhost:8888/Assignment/index.php?page=Logout">Sign out</a>
                    </div>
            </div>
        </div>
    </div>
</header>