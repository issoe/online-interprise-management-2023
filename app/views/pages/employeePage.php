<?php
session_start();
$myModel = new UserModel();

if ($_SESSION["employee_current_id"] < 0) $_SESSION["employee_current_id"] = -1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Employee page</title>
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
            display: block;
            position: fixed;
            bottom: 0;
            right: 15px;
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

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
        .box-task-iz {
            border: 1px solid black;
            border-radius: 5px;
            background-color: #ccc;
            margin: 2px;
            padding: 2px;
        }

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
    <?php require './app/views/components/navbar_employee.php' ?>

    <!-- <button class="open-button" onclick="openForm()">Open Form</button> -->

    <!-- <div class="form-popup" id="myForm">
        <h1>Form submit</h1>
        <form action="index.php" method="POST">
            <input type="hidden" name="formSubmit" value="-1">
            <input type="text" name="resultFromEmployee" value="result-in-text">
            <input type="submit">
        </form>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </div> -->


    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>List of tasks</h3>
    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="py-1" scope="col">No</th>
                    <th class="py-1" scope="col">Task name</th>
                    <th class="py-1" scope="col" style="max-width: 500px;">Description</th>
                    <th class="py-1" scope="col">Status</th>
                    <th class="py-1" scope="col">Created date</th>
                    <th class="py-1" scope="col">Deadline</th>
                    <th class="py-1" scope="col">Date assign</th>
                    <th class="py-1" scope="col">Date submit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $taskList = $myModel->getAllTasks();
                for ($i = 0; $i < sizeof($taskList); $i++) {
                    echo '<tr>';
                    echo '<td class="py-1">' . $taskList[$i]['task_id'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['name'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['description'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['status'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['createdDate'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['deadline'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['assignDate'] . '</td>';
                    echo '<td class="py-1">' . $taskList[$i]['submitDate'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>Your task</h3>

    <div class="table-responsive mt-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="py-1" scope="col">No</th>
                    <th class="py-1" scope="col">Assigner</th>
                    <th class="py-1" scope="col">Task name</th>
                    <th class="py-1" scope="col">Assign date</th>
                    <th class="py-1" scope="col">Dealine</th>
                    <th class="py-1" scope="col">Description from assigner</th>
                    <th class="py-1" scope="col">Description from assignee</th>
                    <th class="py-1" scope="col">Result</th>
                    <th class="py-1" scope="col">Submit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $listTaskById = $myModel->getTasksReceiveByEmployeeId((int)$_SESSION['current_user_id']);
                // echo 'test size' . sizeof($listTaskById);
                for ($i = 0; $i < sizeof($listTaskById); $i++) {
                    $j = $i + 1;
                    echo '<tr>';
                    echo '<td>' . $j . '</td>';
                    $assignerName = 'Admin';
                    $check = $myModel->checkExistEmployeeById($listTaskById[$i]['sender_id']);
                    if ($check == true) $assignerName = $myModel->getEmployeeNameById($listTaskById[$i]['sender_id'])[0]['name'];
                    echo '<td>' . $assignerName . '</td>';

                    echo '<td>' . $listTaskById[$i]['name'] . '</td>';
                    echo '<td>' . $listTaskById[$i]['assignDate'] . '</td>';
                    echo '<td>' . $listTaskById[$i]['deadline'] . '</td>';
                    echo '<td>' . $listTaskById[$i]['des_when_sending'] . '</td>';
                    // echo '<td>' . $listTaskById[$i]['submit_id'] . '</td>';
                    //         echo '<td>Description when submit</td>';
                    //         echo '<td>' . $listTaskById[$i]['result'] . '</td>';
                    //         echo '<td>';
                    //         echo '    <form action="index.php" method="POST">
                    //     <input type="hidden" name="formPopupSubmit" value="-1">
                    //     <input type="hidden" name="submit_current__id" value="' . $listTaskById[$i]['submit_id'] . '">
                    //     <input type="hidden" name="assigner_current__id" value="' . $listTaskById[$i]['sender_id'] . '">
                    //     <input type="submit" value="Submit">
                    // </form>';
                    echo '<form action="index.php" method="POST">
          <td><input type="text" name="des_01" placeholder="Enter description" required></td>
          <td><input type="text" name="res_01" placeholder="Enter result" required></td>
          <input type="hidden" name="assigner_id" value="' . $listTaskById[$i]['sender_id'] . '">
          <input type="hidden" name="whichTask" value="' . $listTaskById[$i]['task_id'] . '">
          <input type="hidden" name="formSubmitByAssignee" value="-1">
          <td><input type="submit" value="Submit" class="btn my-btn"></td>
      </form>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <h3 class="ml-4 mt-4" style="text-decoration: underline;"> <i class="fa-solid fa-list fa-xs mr-1 mt-1"></i>Employee in the same department</h3>
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
                        echo '<td><div style="display: inline-block; width: 100px">
                        <form action="index.php" method="POST">
                            <input type="hidden" name="formPopup" value="-1">
                            <input type="hidden" name="current__Id" value=" ' . $userList[$i]['employee_id'] . '">
                            <input type="submit" value="popup assign task">
                    </form></div></td>';
                    echo '<td>Assign</td>';
                    echo '<td class="px-0 py-2"><div style="display: inline-block; width: 100px;">
                <form>
                <input type="button" class="btn my-btn" value="Assign task" onclick="assignPopupFormFunction(' . $userList[$i]['employee_id'] . ')">
            </form></div></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>



    <?php require './app/views/components/footer.php' ?>

    <script>
        function assignTaskFunction(userId, taskId) {
            console.log('UserId and taskId: ', userId, taskId)
        }

        function AssignFunction(userId) {
            var result = '<?php php_func('userId'); ?>'
            console.log(result)
            // document.write(result);
            document.getElementById("myForm").style.display = "block";
        }

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function assignPopupFormFunction(id) {
            console.log('test', di)
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>