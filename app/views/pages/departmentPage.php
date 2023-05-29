<?php
session_start();
$myModel = new UserModel();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Deparment head</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            /* bottom: 0; */
            /* right: 15px; */
            top: 0;
            left: 0;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

        /* table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        } */

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
        .my-width-des-cell {
            max-width: 400px;
        }


        .container {
            margin-right: 0;
            margin-left: 0;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-repeat: no-repeat;
            background-image: url("Background.jpg");
            background-size: cover;
            background-attachment: fixed;
        }

        .dropbtn {
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
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
            padding-top: 50px;
            /* padding-bottom: 20px;
            text-align: center;
            font-size: 30px; */
        }

        /*
.employee_tasks section {
    text-decoration: none;
    border: 0;
    margin-left: 10%;
    margin-right: 10%;
    font-family: --font-stack;
    height: 370px;
    width: 30%;
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
    &.left {
        float: left;
    }
    &.right {
        float: right;
    }
}
*/

        .employee_tasks {
            text-decoration: none;
            border: 0;
            margin-left: 10%;
            margin-right: 10%;
            font-family: --font-stack;
            height: 600px;
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
            height: 600px;
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
            margin-left: 205px;
        }

        li .dropdown-content {
            min-width: 300px;
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
            border: 1px solid #6b5555;
            text-align: center;
            /* padding: 8px; */

        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        /* 
        table,
        th,
        td {
            place-items: center;
            min-height: 200px;
            border: 5px solid;
            padding: 1rem;
        } */

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

        .de-container {
            display: none;
            position: fixed;
            top: 300px;
            left: 600px;
            background-color: #ccc;
            width: 300px;
        }

        .add-de-container {
            display: none;
            position: fixed;
            top: 300px;
            left: 600px;
            background-color: #ccc;
            width: 300px;
        }

        .ta-container {
            display: none;
            position: fixed;
            top: 300px;
            left: 600px;
            background-color: #ccc;
            width: 300px;
        }

        .add-ta-container {
            display: none;
            position: fixed;
            top: 300px;
            left: 600px;
            background-color: #ccc;
            width: 300px;
        }

        .add-em-container {
            display: none;
            position: fixed;
            top: 300px;
            left: 600px;
            background-color: #ccc;
            width: 300px;
        }

        .box-task-iz {
            border: 1px solid black;
            border-radius: 5px;
            background-color: #ccc;
            margin: 2px;
            padding: 2px;
        }

        /* Use */
        .my-btn {
            /* padding: 10px 20px; */
            font-size: 16px;
            border-radius: 20px;
            background-color: #8127FE;
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .my-btn-2 {
            font-size: 16px;
            border-radius: 15px;
            background-color: #EBD44D;
            color: #2D2000;
            font-weight: 600;
            border: none;
        }

        .my-btn-2:hover {
            background-color: #F9E864;
        }

        .my-btn-3 {
            font-size: 16px;
            border-radius: 15px;
            background-color: #DC3545;
            color: #fff;
            font-weight: 600;
            border: none;
        }

        .my-btn-3:hover {
            background-color: #c82333;
        }

        .my-center-cell {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <?php require './app/views/components/navbar_head.php' ?>
    <!-- <h1>Department head page</h1> -->

    <!-- TODO: DONE-->
    <h3 class="ml-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>List of tasks </h3>
    <button type="button" class="mr-4 btn btn-primary mb-2 my-btn float-right" data-toggle="modal" data-target="#exampleModalCenter"> Create new task </button>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="py-2" scope="col">No</th>
                    <th class="py-2" scope="col">Task name</th>
                    <th class="py-2" scope="col" style="max-width: 500px;">Description</th>
                    <th class="py-2" scope="col">Status</th>
                    <th class="py-2" scope="col">Created date</th>
                    <th class="py-2" scope="col">Deadline</th>
                    <th class="py-2" scope="col">Date assign</th>
                    <th class="py-2" scope="col">Date submit</th>
                    <th class="py-2" scope="col">Update</th>
                    <th class="py-2" scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $taskList = $myModel->getAllTasks();
                for ($i = 0; $i < sizeof($taskList); $i++) {
                    echo '<tr>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['task_id'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['name'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['description'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['status'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['createdDate'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['deadline'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['assignDate'] . '</td>';
                    echo '<td class="py-2 px-2">' . $taskList[$i]['submitDate'] . '</td>';
                    echo '<td class="py-2 px-2"><button class="btn my-btn-2" onclick="pop_Up_Task(\'' . $taskList[$i]['task_id'] .  '\', \'' . $taskList[$i]["name"] . '\', \'' .  $taskList[$i]["description"] . '\', \'' . $taskList[$i]["deadline"] . '\')">Update</button></td>';
                    echo '<td class="py-2 px-2"><button class="btn my-btn-3" onclick="removeTask(' . $taskList[$i]['task_id'] .  ')">Remove</button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- TODO: DONE-->
    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>Review list</h3>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <th class="py-1" scope="col">#</th>
                <th class="py-1" scope="col" colspan="3">Assigner information</th>
                <th class="py-1" scope="col" colspan="2">Deadline</th>
                <th class="py-1" scope="col" colspan="4">Assignee information</th>
                <th class="py-1" scope="col" colspan="2">Modify</th>
            </thead>
            <thead>
                <th class="py-1 px-2">No</th>
                <th class="py-1 px-2">Task name</th>
                <th class="py-1 px-2">Description when sending</th>
                <th class="py-1 px-2">Date sending</th>
                <th class="py-1 px-2">Deadline</th>
                <th class="py-1 px-2">Status</th>
                <th class="py-1 px-2">Receiver</th>
                <th class="py-1 px-2">Description when submit</th>
                <th class="py-1 px-2">Date submit</th>
                <th class="py-1 px-2">Result</th>
                <th class="py-1 px-2">Approve</th>
                <th class="py-1 px-2">Reject</th>
            </thead>
            <tbody>
                <?php
                $listTaskById = $myModel->getTaskResultByAdminId((int)$_SESSION['current_user_id']);

                for ($i = 0; $i < sizeof($listTaskById); $i++) {
                    $j = $i + 1;
                    echo '<tr>';
                    echo '<td class="py-1 px-2">' . $j . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['name'] . '</td>';

                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['des_when_sending'] . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['assignDate'] . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['deadline'] . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['task_status'] . '</td>';

                    echo '<td class="py-1 px-2" class="my-width-des-cell">' . $listTaskById[$i]['description'] . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['deadline'] . '</td>';
                    
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['result'] . '</td>';
                    echo '<td class="py-1 px-2">' . $listTaskById[$i]['submit_id'] . '</td>';
                    echo '<td class="py-1 px-2"><form action="index.php" method="POST">
                    <input type="hidden" name="approveForm" value="-1">
                    <input type="hidden" name = "approveValue" value="' . $listTaskById[$i]['submit_id'] . '">
                    <input type="hidden" name = "_taskId" value="' . $listTaskById[$i]['task_id'] . '">
                    <input type="submit" value="Approve" class="btn my-btn">
                </form></td>';
                    echo '<td class="py-1 px-2"><form action="index.php" method="POST">
                    <input type="hidden" name="rejectForm" value="-1">
                    <input type="hidden" name = "rejectValue" value="' . $listTaskById[$i]['submit_id'] . '">
                    <input type="hidden" name = "_taskId" value="' . $listTaskById[$i]['task_id'] . '">
                    <input type="submit" value="Reject" class="btn my-btn-3">
                </form></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- TODO: DONE-->
    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>Employee list</h3>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="py-1" scope="col">No</th>
                    <th class="py-1" scope="col">Full Name</th>
                    <th class="py-1" scope="col">Account</th>
                    <th class="py-1" scope="col">Password</th>
                    <th class="py-1" scope="col">Role</th>
                    <th class="py-1" scope="col">Level</th>
                    <th class="py-1" scope="col">Department</th>
                    <th class="py-1" scope="col">Done tasks</th>
                    <th class="py-1" scope="col">On-doing tasks</th>
                    <th class="py-1" scope="col" style="max-width: 100px;">Pick to my department</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userList = $myModel->getUserList();
                for ($i = 0; $i < sizeof($userList); $i++) {
                    echo '<tr>';
                    echo '<td class="py-1 px-2">' . $userList[$i]['employee_id'] . '</td>';
                    echo '<td class="py-1 px-2">' . $userList[$i]['name'] . '</td>';
                    echo '<td class="py-1 px-2">' . $userList[$i]['username'] . '</td>';
                    echo '<td class="py-1 px-2">' . str_repeat('*', strlen($userList[$i]['password'])) . '</td>';
                    $role = '';
                    if ($userList[$i]['role'] == 'head') $role = 'Head';
                    echo '<td class="py-1 px-2">' . $role . '</td>';

                    $tempLevel = '';
                    if ($userList[$i]['level'] > 0)  $tempLevel = $userList[$i]['level'];
                    echo '<td class="py-1 px-2">' . $tempLevel . '</td>';

                    $departmentname = $myModel->getDepartmentNameById((int)$userList[$i]['department_id']);
                    echo '<td class="py-1 px-2">' . $departmentname[0]['name'] . '</td>';


                    echo '<td class="py-1 px-2">';
                    $tempName = $myModel->getTaskDoneByEmployeeId($userList[$i]['employee_id']);
                    for ($j = 0; $j < sizeof($tempName); $j++) {
                        // echo $tempName[$j]['name'] . ', ';
                        echo '<div class="box-task-iz" style="display: inline-block"> ' . $tempName[$j]['name'] . '</div>';
                    }
                    echo '</td>';

                    echo '<td class="py-1 px-2">';
                    $tempName = $myModel->getTaskOnDoingByEmployeeId($userList[$i]['employee_id']);
                    for ($j = 0; $j < sizeof($tempName); $j++) {
                        echo '<div class="box-task-iz" style="display: inline-block"> ' . $tempName[$j]['name'] . '</div>';
                    }
                    echo '</td>';
                    echo '<td class="py-1 px-2"><button class="btn my-btn" onclick="pickEmployeeFunction(' . $userList[$i]['employee_id'] . ')">Select</button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- TODO: DONE-->
    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>Employee in your department</h3>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="py-2" scope="col">No</th>
                    <th class="py-2" scope="col">Full Name</th>
                    <th class="py-2" scope="col">Account</th>
                    <th class="py-2" scope="col">Password</th>
                    <th class="py-2" scope="col">Role</th>
                    <th class="py-2" scope="col">Level</th>
                    <th class="py-2" scope="col">Department</th>
                    <th class="py-2" scope="col">Done tasks</th>
                    <th class="py-2" scope="col">On-doing tasks</th>
                    <th class="py-2" scope="col">Assign task</th>
                    <th class="py-2" scope="col">Out depertment</th>
                    <th class="py-2" scope="col">Change level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $myModel->getCurrentIdDeparmentByUserId();
                $userList = $myModel->getEmloyeesByDeparmentId($id[0]['department_id']);
                for ($i = 0; $i < sizeof($userList); $i++) {
                    echo '<tr>';
                    echo '<td class="px-1 py-2">' . $userList[$i]['employee_id'] . '</td>';
                    echo '<td class="px-1 py-2">' . $userList[$i]['name'] . '</td>';
                    echo '<td class="px-1 py-2">' . $userList[$i]['username'] . '</td>';
                    echo '<td class="px-1 py-2">' . str_repeat('*', strlen($userList[$i]['password'])) . '</td>';
                    $role = '';
                    if ($userList[$i]['role'] == 'head') $role = 'Head';
                    echo '<td class="px-1 py-2">' . $role . '</td>';

                    $tempLevel = '';
                    if ($userList[$i]['level'] > 0)  $tempLevel = $userList[$i]['level'];
                    echo '<td class="px-1 py-2">' . $tempLevel . '</td>';

                    $departmentname = $myModel->getDepartmentNameById((int)$userList[$i]['department_id']);
                    echo '<td class="px-1 py-2">' . $departmentname[0]['name'] . '</td>';

                    echo '<td class="px-1 py-2">';
                    $tempName = $myModel->getTaskDoneByEmployeeId($userList[$i]['employee_id']);
                    for ($j = 0; $j < sizeof($tempName); $j++) {
                        // echo $tempName[$j]['name'] . ', ';
                        echo '<div class="box-task-iz" style="display: inline-block"> ' . $tempName[$j]['name'] . '</div>';
                    }
                    echo '</td>';

                    echo '<td class="px-1 py-2">';
                    $tempName = $myModel->getTaskOnDoingByEmployeeId($userList[$i]['employee_id']);
                    for ($j = 0; $j < sizeof($tempName); $j++) {
                        echo '<div class="box-task-iz" style="display: inline-block"> ' . $tempName[$j]['name'] . '</div>';
                    }
                    echo '</td>';
                    //     echo '<td><div style="display: inline-block; width: 100px">
                    //     <form action="index.php" method="POST">
                    //         <input type="hidden" name="formPopup" value="-1">
                    //         <input type="hidden" name="current__Id" value=" ' . $userList[$i]['employee_id'] . '">
                    //         <input type="submit" value="popup assign task">
                    // </form></div></td>';
                    // echo '<td>Assign</td>';
                    echo '<td class="px-0 py-2"><div style="display: inline-block; width: 100px">
                <form>
                <input type="button" class="btn my-btn" value="Assign task" onclick="assignPopupFormFunction(' . $userList[$i]['employee_id'] . ')">
            </form></div></td>';
                    echo '<td class="px-1 py-2"><button class="btn my-btn-3" onclick="removeOut(' . $userList[$i]['employee_id'] .  ')">Remove</button></td>';

                    echo '<td class="px-1 py-2">   <form action="index.php" method="POST">
                <select name="changeLevelSelection">
                    <option value="__unknown_2">--</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                </select>
                <input type="hidden" name="employeeId" value="' . $userList[$i]['employee_id'] . '">
                <input type="hidden" name="formChangeLevelByHead">
                <input type="submit" class="btn my-btn" value="Change">
            </form></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php require './app/views/components/footer.php' ?>

    <div class="modal" tabindex="-1" role="dialog" id="myForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="index.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Available tasks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeForm()">
                            <span aria-hidden=" true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        // echo '<div style="display: block;" id="tester">Id: ' . $_SESSION["employee_current_id"] . '</div>';
                        // echo 'Name: ' . $userList[(int)$_SESSION["employee_current_id"]]['name'];
                        $tasksNotCompleted = $myModel->getTasksNotCompleted();
                        for ($i = 0; $i < sizeof($tasksNotCompleted); $i++) {
                            echo '<div class="form-group">';
                            // echo $tasksNotCompleted[$i]['name'] . '</br>';
                            echo '<label style="font-weight: 600"> ' . $tasksNotCompleted[$i]['name'] . '</label>';
                            echo '<form action="index.php" method="POST">
                            <input type="hidden" name="formAssignByHead" value="-1">
                            <input type="hidden" name="assignerId" value="' . $_SESSION['current_user_id'] . '">
                            <input type="hidden" name="taskId" value="' . $tasksNotCompleted[$i]['task_id'] . '">
                            <input type="hidden" name="employeeId" value="' . $_SESSION["employee_current_id"] . '">
                            <input type="text" name="description001" value="description when assign" required class="form-control">
                            <input type="submit" value ="assign" class="btn my-btn my-2">
                        </form> ';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeForm()">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create new task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="POST">
                        <div>
                            <label for="">Task name</label>
                            <input type="text" name="taskName" required>
                        </div>
                        <div>
                            <label for="">Description</label>
                            <input type="text" name="taskDescription" required>
                        </div>
                        <div>
                            <label for="">Deadline</label>
                            <input type="text" name="taskDeadline" required>
                        </div>
                        <input type="hidden" name="formAddTaskByHead" value="-1">
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>

    <!-- END -->


    <!-- FORM_001 -->
    <div class="de-container" id="form001">
        <form action="index.php" method="POST">
            <h3>Update department</h3>
            <button onclick="dropdownUpdateDepartment()">_X_</button>
            <div>
                <label for="">Department name</label>
                <input type="text" id="form001_name" name="newDepartmentName">
            </div>
            <div>
                <label for="">Currently head</label>
                <input type="text" id="form001_head" value="0" name="oldDepartmentHeadName">
            </div>
            <label for="">New department head</label>
            <select name="newHeadName">
                <option value="__unknown_1">--</option>
                <?php
                $list = $myModel->getEmloyees();
                for ($i = 0; $i < sizeof($list); $i++) {
                    echo '<option value="' . $list[$i]['name'] . '">' . $list[$i]['name'] . '</option>';
                }
                ?>
            </select>
            <div><label for="">Note</label>
                <input type="text" id="form001_notes" name="newNotes">
            </div>
            <input type="hidden" id="form001_id" name="fixId">
            <input type="hidden" name="formUpdateDepartment" value="-1">
            <input type="submit">
        </form>
    </div>

    <!-- FORM_002 -->
    <div class="add-de-container" id="form002">
        <form action="index.php" method="POST">
            <h3>New department</h3>
            <button onclick="hidePopupAddDepartment()">_X_</button>
            <div>
                <label for="">Department name</label>
                <input type="text" name="newName" required>
            </div>
            <!-- In mac note (izo_01) -->
            <div><label for="">Note</label>
                <input type="text" name="newNote">
            </div>

            <input type="hidden" name="formAddDepartment" value="-1">
            <input type="submit">
        </form>
    </div>

    <!-- FORM_003: UPDATE TASK -->
    <!-- <div class="ta-container" id="form003">
        <form action="index.php" method="POST">
            <h3>Update task</h3>
            <button onclick="hideUpdateTask()">_X_</button>
            <div>
                <label for="">Task name</label>
                <input type="text" id="form003_name" name="taskname">
            </div>
            <div>
                <label for="">Description</label>
                <input type="text" id="form003_des" name="taskDescription">
            </div>
            <div>
                <label for="">Dealine</label>
                <input type="text" id="form003_dead" name="taskDeadline">
            </div>
            <input type="hidden" id="form003_id" name="fixId">
            <input type="hidden" name="formUpdateTaskByHead" value="-1">
            <input type="submit">
        </form>
    </div> -->

    <div class="modal" tabindex="-1" role="dialog" id="form003">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="index.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Update task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideUpdateTask()">
                            <span aria-hidden=" true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Task name</label>
                            <input type="text" id="form003_name" name="taskname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Task name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" id="form003_des" name="taskDescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Dealine</label>
                            <input type="text" id="form003_dead" name="taskDeadline" class="form-control" id="exampleInputPassword1" placeholder="Deadline">
                            <input type="hidden" id="form003_id" name="fixId">
                            <input type="hidden" name="formUpdateTask" value="-1">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideUpdateTask()">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FORM_004: CREATE NEW TASK -->
    <div class="add-ta-container" id="form004">
        <form action="index.php" method="POST">
            <h3>New task</h3>
            <button onclick="hidePopupAddTask()">_X_</button>
            <div>
                <label for="">Task name</label>
                <input type="text" name="taskName" required>
            </div>
            <div>
                <label for="">Description</label>
                <input type="text" name="taskDescription" required>
            </div>
            <div>
                <label for="">Deadline</label>
                <input type="text" name="taskDeadline" required>
            </div>
            <input type="hidden" name="formAddTaskByHead" value="-1">
            <input type="submit">
        </form>
    </div>

    <!-- FORM_005: CREATE NEW EMPLOYEE -->
    <div class="add-em-container" id="form005">
        <button onclick="hidePopupAddEmployee()">_X_</button>
        <form action="index.php" method="POST">
            <h3>Create new task</h3>
            <div>
                <label for="">Full name</label>
                <input type="text" name="fullname" required>
            </div>
            <div>
                <label for="">Username</label>
                <input type="email" name="username" required>
            </div>
            <input type="hidden" name="formAddEmployee" value="-1">
            <input type="submit">
        </form>
    </div>

    <script>
        function assignTaskFunction(userId, taskId) {
            console.log('UserId and taskId: ', userId, taskId)
        }

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function assignPopupFormFunction(input_id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {}
            };
            xhttp.open("POST", "index.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            data = "assignPopupForm=-1&id=" + input_id;
            // xhttp.send("format=json&second=value"); // nicer, dont remove
            xhttp.send(data);
            document.getElementById("myForm").style.display = "block";
        }

        function showUpdatePopup(input_id) {
            $.ajax({
                url: "index.php",
                type: "POST",
                data: {
                    showPopup: "showPopup",
                    id: input_id
                },
                success: function(response) {}
            });
            document.getElementById("form001").style.display = "block";
            // location.reload();
        }

        function pop_Up_Department(id, name, head, notes) {
            document.getElementById("form001_id").value = id;
            document.getElementById("form001_name").value = name;
            document.getElementById("form001_head").value = head;
            document.getElementById("form001_notes").value = notes;
            document.getElementById("form001").style.display = "block";
        }

        function pop_Up_Task(id, name, des, dead) {
            // console.log(id, name, des, dead)
            document.getElementById("form003_id").value = id;
            document.getElementById("form003_name").value = name;
            document.getElementById("form003_des").value = des;
            document.getElementById("form003_dead").value = dead;
            document.getElementById("form003").style.display = "block";
        }

        function removeDepartment(id) {
            if (confirm("Do you want to remove this department?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        location.reload();
                    }
                };
                xhttp.open("POST", "index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "removeDepartment=-1&id=" + id;
                // xhttp.send("format=json&second=value"); // nicer, dont remove
                xhttp.send(data);
            } else return false;
        }

        function removeTask(id) {
            if (confirm("Do you want to remove this task?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        location.reload();
                    }
                };
                xhttp.open("POST", "index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "removeTask=-1&id=" + id;
                // xhttp.send("format=json&second=value"); // nicer, dont remove
                xhttp.send(data);
            } else return false;
        }

        function removeEmployee(id) {
            if (confirm("Do you want to remove this employee?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        location.reload();
                    }
                };
                xhttp.open("POST", "index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "removeEmployee=-1&id=" + id;
                // xhttp.send("format=json&second=value"); // nicer, dont remove
                xhttp.send(data);
            } else return false;
        }

        function pickEmployeeFunction(id) {
            if (confirm("Do you want to pick this employee to your department?")) {
                // console.log(id);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        location.reload();
                    }
                };
                xhttp.open("POST", "index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "pickEmployeeForm=-1&id=" + id
                // xhttp.send("format=json&second=value"); // nicer, dont remove
                xhttp.send(data);
            } else return false;
        }

        function removeOut(id) {
            if (confirm("Do you want to remove out of your department?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        location.reload();
                    }
                };
                xhttp.open("POST", "index.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "removeOut=-1&id=" + id;
                // xhttp.send("format=json&second=value"); // nicer, dont remove
                xhttp.send(data);
            } else return false;
        }

        function dropdownUpdateDepartment() {
            document.getElementById("form001").style.display = "none";
        }

        function showPopupAddDepartment() {
            document.getElementById("form002").style.display = "block";
        }

        function hidePopupAddDepartment() {
            document.getElementById("form002").style.display = "none";
        }

        function hideUpdateTask() {
            document.getElementById("form003").style.display = "none";
        }

        function hidePopupAddTask() {
            document.getElementById("form004").style.display = "none";
        }

        function showPopupAddTask() {
            document.getElementById("form004").style.display = "block";
        }

        function hidePopupAddEmployee() {
            document.getElementById("form005").style.display = "none";
        }

        function showPopupAddEmployee() {
            document.getElementById("form005").style.display = "block";
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>