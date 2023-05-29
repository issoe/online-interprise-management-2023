<?php
// Section 
session_start();

if (!$_SESSION['username']) $_SESSION['username'] = 'User';
if (!$_SESSION['current_user_id']) $_SESSION['current_user_id'] = 0;
if ($_SESSION["employee_current_id"] < 0) $_SESSION["employee_current_id"] = -1;
if (!$_SESSION['loginBtn']) $_SESSION['loginBtn'] = 'Login';
// if (!$_SESSION['selectedUser']) $_SESSION['selectedUser'] = 'Unkno';

// if ($_SESSION["assigner_current_id"] < 0) $_SESSION["assigner_current_id"] = -1;
if ($_SESSION["submit_current_id"] < 0) $_SESSION["submit_current_id"] = -1;
// if (!$_SESSION['password']) $_SESSION['password'] = '';

// Import controller
require_once './app/controllers/UserController.php';
$controller = new UserController();

if (isset($_POST['removeOut'])) {
    $id = $_POST["id"];
    $controller->removeOut($id);
} else if (isset($_POST['pickEmployeeForm'])) {
    $id = $_POST["id"];
    // echo $id;
    $success = $controller->pickEmployee($id);
    if ($success == false) echo "Employee currently is a department head or beloging in another department!"; 
    else echo "Success";
} else if (isset($_POST['formAddEmployee'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $controller->createEmployee($fullname, $username);
    $controller->admin();
    echo "<script type='text/javascript'>alert('You created successfully new emloyee');</script>";
} else if (isset($_POST['removeEmployee'])) {
    $id = $_POST["id"];
    $controller->removeEmployeeById($id);
} else if (isset($_POST['formSubmitByAssignee'])) {
    $des = $_POST['des_01'];
    $res = $_POST['res_01'];
    $sender_id = $_POST['assigner_id'];
    $whichtask = $_POST['whichTask'];
    // echo $des . $res . $sender_id;
    $controller->submitTaskByAssignee($sender_id, $res, $des, $whichtask);
    $controller->employee();
} else if (isset($_POST['formChangeLevelByHead'])) {
    $newLevel = $_POST['changeLevelSelection'];
    $employeeId = $_POST['employeeId'];
    $controller->newLevelById($employeeId, $newLevel);
    $controller->departmenthead();
} else if (isset($_POST['formChangeLevel'])) {
    $newLevel = $_POST['changeLevelSelection'];
    $employeeId = $_POST['employeeId'];
    $controller->newLevelById($employeeId, $newLevel);
    $controller->admin();
} else if (isset($_POST['formUpdateTask'])) { // Done
    $id = $_POST['fixId'];
    $name = $_POST['taskname'];
    $des = $_POST['taskDescription'];
    $dead = $_POST['taskDeadline'];
    $controller->updateTask($id, $name, $des, $dead);
    $controller->admin();
} else if (isset($_POST['formUpdateTaskByHead'])) { // Done
    $id = $_POST['fixId'];
    $name = $_POST['taskname'];
    $des = $_POST['taskDescription'];
    $dead = $_POST['taskDeadline'];
    $controller->updateTask($id, $name, $des, $dead);
    $controller->departmenthead();
} else if (isset($_POST['removeTask'])) { // Done
    $id = $_POST["id"];
    $controller->removeTaskById($id);
} else if (isset($_POST['removeDepartment'])) { // Done
    $id = $_POST["id"];
    $controller->removeDepartmentById($id);
} else if (isset($_POST['showPopup'])) {
    $_SESSION["employee_current_id"] = (int)$_POST['id'];
} else if (isset($_POST['showPopupByPost'])) {
    $_SESSION["employee_current_id"] = (int)$_POST['id'];
    $controller->admin();
} else if (isset($_POST['formUpdateDepartment'])) { // Done
    $id = $_POST['fixId'];
    $newDepartmentName = $_POST['newDepartmentName'];
    $newHeadName = $_POST['newHeadName'];
    $newNotes = $_POST['newNotes'];
    $result = $controller->updateDepartment($id, $newDepartmentName, $newHeadName, $newNotes);
    $controller->admin();
    if ($result == false)  echo "<script type='text/javascript'>alert('" . $newHeadName . " was being a head in another department');</script>";
} else if (isset($_POST['formAddTask'])) {
    $name = $_POST['taskName'];
    $des = $_POST['taskDescription'];
    $dead = $_POST['taskDeadline'];
    $controller->createTask($name, $des, $dead);
    $controller->admin();
    echo "<script type='text/javascript'>alert('You created successfully new task');</script>";
} else if (isset($_POST['formAddTaskByHead'])) {
    $name = $_POST['taskName'];
    $des = $_POST['taskDescription'];
    $dead = $_POST['taskDeadline'];
    $controller->createTask($name, $des, $dead);
    $controller->departmenthead();
    echo "<script type='text/javascript'>alert('You created successfully new task');</script>";
} else if (isset($_POST['formAddDepartment'])) {  // Done
    $name = $_POST['newName'];
    $head = 'empty';
    $note = $_POST['newNote'];
    if ($note == '') $note = '-';
    $controller->createDepartment($name, $head, $note);
    $controller->admin();
    echo "<script type='text/javascript'>alert('You created successfully new department');</script>";
} else if (isset($_POST['formAssign'])) {
    $assigner_Id = $_POST['assignerId'];
    $task_Id = $_POST['taskId'];
    // $employee_Id = $_POST['employeeId'];
    $employee_Id = $_SESSION["employee_current_id"];
    $description = $_POST['description001'];
    $controller->formAssign($assigner_Id, $description, $task_Id, $employee_Id);
    $controller->admin();
} else if (isset($_POST['formAssignByHead'])) {
    $assigner_Id = $_POST['assignerId'];
    $task_Id = $_POST['taskId'];
    // $employee_Id = $_POST['employeeId'];
    $employee_Id = $_SESSION["employee_current_id"];
    $description = $_POST['description001'];
    $success = $controller->formAssign($assigner_Id, $description, $task_Id, $employee_Id);
    $controller->departmenthead();
    if ($success == false) echo "<script type='text/javascript'>alert('Wrong role');</script>"; 
} else if (isset($_POST['assignPopupForm'])) {
    $_SESSION["employee_current_id"] = (int)$_POST['id'];
    // echo json_encode(array('success' => true));
} else if (isset($_POST['formSubmit'])) {
    // $submitId = $_POST['submitId_'];
    $result = $_POST['resultFromEmployee'];
    $controller->submitProcessing((int)$_SESSION["submit_current_id"], $result);
    $controller->employee();
} else if (isset($_POST['formPopupSubmit'])) {
    if (isset($_POST["assigner_current__id"])) {
        // echo 'assigner id currently: ' . $_SESSION["assigner_current_id"];
        // $_SESSION["assigner_current_id"] = $_POST["assigner_current__id"];
        $_SESSION["submit_current_id"] = $_POST["submit_current__id"];
    }
    $controller->employee();
} else if (isset($_POST['approveForm'])) {
    $submit_id = $_POST['approveValue'];
    $_taskId_ = $_POST['_taskId'];
    $controller->approve($submit_id, $_taskId_);
    $controller->admin();
} else if (isset($_POST['rejectForm'])) {
    $submit_id = $_POST['rejectValue'];
    $_taskId_ = $_POST['_taskId'];
    $controller->reject($submit_id, $_taskId_);
    $controller->admin();
} else {
    $page = 'home';
    if (isset($_GET['page']))
        $page = $_GET['page'];
    else if (isset($_POST['page']))
        $page = $_POST['page'];

    // redirect to page 
    $page = strtolower($page);
    if ($page == 'home') {
        $controller->home();
    } else if ($page == 'login') {
        $controller->login();
    } else if ($page == 'logout') {
        $controller->logout();
    } else if ($page == 'dashboard') {
        $controller->dashboard();
    } else if ($page == 'admin') {
        $controller->admin();
    } else if ($page == 'task') {
        $controller->task();
    } else if ($page == 'department') {
        $controller->departmenthead();
    } else if ($page == 'employee') {
        $controller->employee();
    } else {
        echo 'Page: ' . $page;
        $controller->error404();
    }
}
