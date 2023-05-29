<?php
session_start();
include './app/models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function home()
    {
        include './app/views/pages/homePage.php';
    }

    public function login() {
        $loginSuccess = $this->model->login();
        if ($loginSuccess == true) {
            $_SESSION['loginBtn'] = 'Logout';
            $role = $this->model->getRole();
            // echo $role;
            if ($role == 'admin') header("location: http://localhost:8888/Assignment/index.php?page=admin");
            else if ($role == 'employee') header("location: http://localhost:8888/Assignment/index.php?page=employee");
            else header("location: http://localhost:8888/Assignment/index.php?page=department");
        } else {
            include './app/views/pages/loginPage.php';
        }
    }

    public function logout() {
        // session_destroy();
        $_SESSION['username'] = 'User';
        $_SESSION['loginBtn'] = 'Login';
        $_SESSION['current_user_id'] = -2;
        include './app/views/pages/homePage.php';
    }

    public function dashboard()
    {
        include './app/views/pages/dashboard.php';
    }

    public function admin()
    {
        include './app/views/pages/adminPage.php';
    }

    public function departmenthead()
    {
        include './app/views/pages/departmentPage.php';
    }

    public function employee()
    {
        $userList = $this->model->getUserList();
        include './app/views/pages/employeePage.php';
    }

    public function error404()
    {
        require_once './app/views/pages/error404.php';
    }

    public function formAssign($assigner_Id, $des, $task_Id, $employee_Id) {
        $success = $this->model->assign($assigner_Id, $des, $task_Id, $employee_Id);
        return $success;
    }

    public function task()
    {
        include './app/views/pages/taskPage.php';
    }

    public function submitProcessing($submitId, $resultInText)
    {
        $this->model->submitProcessing_($submitId, $resultInText);
        // echo 'Submit processding: ' . $resultInText . ', ' . $assignerId;
    }

    public function approve($submit_id, $_taskId_)
    {
        $this->model->approve_($submit_id, $_taskId_);
    }

    public function reject($submit_id, $_taskId_)
    {
        $this->model->reject_($submit_id, $_taskId_);
    }

    public function updateDepartment($id, $newDepartmentName, $newHeadName, $newNotes) {
        // Mission 1: check whether headName was belong in another department or not
        $check = $this->model->isHeadInAnotherDepartment($newHeadName);
        if ($check == true) return false;

        // Mission 2: remove head of current employee
        $this->model->removeHeadPositionByDepartmentId($id);

        // Mission 3: If not in another deparment, update record
        $this->model->updateDepartmentById($id, $newDepartmentName, $newHeadName, $newNotes);
        return true;
    }

    public function removeDepartmentById($id) {
        $this->model->removeDepartmentById_($id);
    }
    
    public function removeTaskById($id) {
        $this->model->removeTaskById_($id);
    }

    public function removeEmployeeById($id) {
        $this->model->removeEmployeeById_($id);
    }

    public function createDepartment($name, $head, $note){
        $this->model->createDepartment_($name, $head, $note);
    }

    public function createTask($name, $head, $note){
        $this->model->createTask_($name, $head, $note);
    }

    public function updateTask($id, $name, $des, $dead) {
        // Only update without consideration any information
        $this->model->updateTaskById($id, $name, $des, $dead);
    }

    public function newLevelById($id, $newLevel) {
        $this->model->newLevelById_($id, $newLevel);
    }

    public function submitTaskByAssignee($sender_id, $res, $des, $whichtask) {
        $this->model->submitTaskByAssignee_($sender_id, $res, $des, $whichtask);
    }

    public function createEmployee($fullname, $username) {
        $this->model->createEmployee_($fullname, $username);
    }

    public function pickEmployee($id) {
        $res = $this->model->pickEmployee_($id);
        return $res;
    }

    public function removeOut($id) {
        $this->model->removeOut_($id);
    }
}