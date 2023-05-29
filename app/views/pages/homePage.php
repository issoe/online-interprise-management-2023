<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-repeat: no-repeat;
            background-image: url("public/img/Homepage.jpg");
            background-size: cover;
            background-attachment: fixed;
        }

        #box {
            display: absolute;
            height: 600px;
            width: 55%;
            backdrop-filter: blur(15px);
            justify-content: center;
            align-items: center;
            margin: auto;
            margin-top: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background: #dbddf0a6;
            box-sizing: border-box;
            overflow: hidden;
            box-shadow: 0 20px 50px rgb(23, 32, 90);
            border: 2px solid #2a3cad;
            overflow: auto;
        }

        #box::-webkit-scrollbar {
            background-color: transparent;
            width: 0.5em;
        }

        #box::-webkit-scrollbar-thumb {
            background-color: transparent;
        }

        .information {
            font-size: 30px;
            color: black;
            margin-top: 50px;
        }

        p {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
            text-align: justify;
            font-size: 25px;
        }

        .information li {
            padding-left: 40px;
            padding-right: 20px;
            padding-top: 20px;
            text-align: justify;
            font-size: 20px;
        }

        h2 {
            color: orange;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 20px;
            text-align: center;
            font-size: 30px;
        }

        .de-container {
            position: fixed;
            top: 300px;
            left: 600px;
            display: none;
            background-color: #ccc;
            width: 300px;
        }
        .employee_tasks {
            text-decoration: none;
            border: 0;
            margin-left: 10%;
            margin-right: 10%;
            font-family: --font-stack;
            height: 420px;
            width: 80%;
            text-align: justify;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            background-color: whitesmoke;
            box-shadow: 0 20px 50px rgb(23, 32, 90);
            border: 2px solid #2a3cad;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .employee_tasks .button_to_do {
            margin-left: 250px;
        }

        .task_number_decoration {
            margin: -10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
            font-weight: 700;
            height: 50px;
            background-color: yellow;
        }

        .task_number_information {
            padding-top: 10px;
            font-size: 25px;
        }

        .button_to_do {
            margin-top: 140px;
            margin-left: 42px;
            padding-left: 10px;
            padding-right: 10px;
            font-size: 17px;
            text-align: center;
            background-color: gainsboro;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .redo_tasks {
            text-decoration: none;
            border: 0;
            margin-left: 10%;
            margin-right: 10%;
            font-family: --font-stack;
            height: 520px;
            width: 80%;
            text-align: justify;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            background-color: whitesmoke;
            box-shadow: 0 20px 50px rgb(23, 32, 90);
            border: 2px solid #2a3cad;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .redo_tasks .button_to_do {
            margin-left: 250px;
        }

        li .dropdown-content {
            min-width: 200px;
        }

        /* POP UP */
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .wrapper {
            margin: 70px auto;
            padding: 20px;
            background: #e7e7e7;
            border-radius: 5px;
            width: 70%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .wrapper h2 {
            margin-top: 0;
            color: #333;
        }

        .wrapper .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .wrapper .close:hover {
            color: #06D85F;
        }

        .wrapper .content {
            max-height: 30%;
            overflow: auto;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        table,
        th,
        td {
            place-items: center;
            min-height: 200px;
            border: 5px solid;
            padding: 1rem;
        }

        .wrapper {
            max-height: 600px;
            /* or any other value you prefer */
            overflow-y: auto;
        }

        .wrapper::-webkit-scrollbar {
            background-color: transparent;
            width: 0.5em;
        }

        .wrapper::-webkit-scrollbar-thumb {
            background-color: transparent;
        }

        h1 {
            position: absolute;
            font-size: 8em;
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: Arial;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            background: linear-gradient(to right, #f32170, #ffeb07, #2196f3, #ff00eb);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
        }

        h2 {
            font-size: 4em;
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: Arial;
            position: absolute;
            top: 72.5%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
        }

        .information button {
            margin: 0;
            border: 0;
            position: absolute;
            font-size: 20px;
            top: 85%;
            padding: 5px 10px 5px 10px;
            margin-left: 42.5%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            border-radius: 5px;
            background-color: #ED6A5A;
            transform: scale(1);
            transition: .2s;
        }
    </style>
</head>

<body>
    <?php  //require './app/views/components/navbar.php' 
    ?>

    <!-- <h1>Home page</h1>

    <div class="de-container">
        <form action="">
            <h3>Update department</h3>
            <label for="">Department name</label>
            <input type="text">
            <label for="">Department head</label>
            <input type="text">
            <label for="">Notes</label>
            <input type="text">
            <input type="submit">
        </form>
    </div> -->

    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-house-user"> Home</i></a></li>
                    <!-- <li style="padding-left: 10px;"><a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-bars" style="color: #ffffff;"> Product</i></a></li> -->
                    <!-- <li style="padding-left: 10px;"><a href="#" class="nav-link px-2 text-white"><i class="fa-regular fa-calendar" style="color: #ffffff;"> Event</i></a></li>
                    <li style="padding-left: 10px;"><a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-users"> About Us</i></a></li>
                    <li style="padding-left: 10px;"><a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-user-doctor" style="color: #ffffff;"> Career</i></a></li> -->
                </ul>

                <div class="text-end">
                    <button onclick="document.location=''" type="button" class="btn btn-outline-light me-2"><i class="fa-solid fa-right-to-bracket"> <?php
                                                                                                                                                        echo '<a style="border: 1px solid black;" href="http://localhost:8888/Assignment/index.php?page=' . $_SESSION['loginBtn'] . '">' . $_SESSION['loginBtn'] . '</a>';
                                                                                                                                                        ?></i></button>
                    <!-- <button type="button" class="btn btn-warning"><i class="fa-solid fa-memo-circle-info" style="color: #ffffff;"> Register</i></button> -->
                </div>
            </div>
        </div>
    </header>

    <div class="information">
        <h1 style="font-size: 60px; font-style: italic; font-weight: bold;">"Committed to Excellence,<br>Dedicated to Your Satisfaction."</h1>
        <h2 style="font-size: 25px;">Our aim is to provide innovative and high-quality products and services that exceed our customers' expectations.</h2>
    </div>

    <script src="https://kit.fontawesome.com/fc8a8c5ee5.js" crossorigin="anonymous"></script>
</body>
</body>

</html>