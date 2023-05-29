<?php
session_start();
include './config/db.php';

class UserModel
{
    private $conn;
    public function __construct()
    {
        $db = new db();
        $this->conn = $db->getConn();
    }

    public function login()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            if ($username == 'admin@mail.com' && $password == 'admin') {
                $_SESSION['username'] = $username;
                $_SESSION['current_user_id'] = -1;
                // echo 'Current id (admin): ' . $_SESSION['current_user_id'];
                return true;
            }

            $sql = 'SELECT * FROM employee e WHERE e.username = "' . $username . '" AND e.password = "' . $password . '"';
            $result = $this->conn->query($sql);

            if ($result->num_rows) {
                $_SESSION['username'] = $username;
                $userId = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $_SESSION['current_user_id'] = $userId[0]['employee_id'];
                $_SESSION['department_name'] = $this->getDepartmentNameById($userId[0]['department_id'])[0]['name'];
                return true;
            } else {
                return false;
            }
            return false;
        }
        return false;
    }

    public function getUserList()
    {
        $sql = 'SELECT * FROM Employee ORDER BY level DESC';
        $result = $this->conn->query($sql);
        $userList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $userList;
    }

    public function getEmloyeesByDeparmentId($departmentId)
    {
        $sql = 'SELECT * FROM employee e WHERE e.department_id = ' . $departmentId;
        $result = $this->conn->query($sql);
        $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $list;
    }

    public function getRole()
    {
        if ($_SESSION['current_user_id'] == -1) return 'admin';
        else {
            $sql = 'SELECT * FROM employee e WHERE e.employee_id = ' . $_SESSION['current_user_id'];
            // echo $sql;
            $result = $this->conn->query($sql);
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($result->num_rows) return $res[0]['role'];
            echo 'Fault role';
            return 'Fault role';
        }
    }

    // Here, i conconvert admin = 5, header = 3, level3 = 3, level2 = 2, level1 = 1
    public function getCapacityByEmployeeId($employeeId)
    {
        if ($employeeId == -1) return 5;
        else {
            $sql = 'SELECT * FROM employee e WHERE e.employee_id = ' . $employeeId;
            $result = $this->conn->query($sql);
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($res[0]['role'] == 'head') return 4;
            return $res[0]['level'];
        }
    }

    public function checkRole($employeeId)
    {
        $currentCapacity = $this->getCapacityByEmployeeId($_SESSION['current_user_id']);
        $employeeCapacity = $this->getCapacityByEmployeeId($employeeId);
        if ($currentCapacity > $employeeCapacity) return true;
        echo 'Fault role';
        return false;
    }

    public function assign($assignerId, $des, $taskId, $employeeId)
    {
        // Mission 1: Check role is suitable or not
        if ($this->checkRole($employeeId) == false) return false;

        // Mission 2: Assign task to employee
        $date = date("d/m/Y");
        $sql = "INSERT INTO assignment (submit_id, sender_id, des_when_sending, date_sending, task_id, task_status, receiver_id, des_when_submit, date_submit, result)
        VALUES (NULL, " . $_SESSION['current_user_id'] . ", '" . $des . "', '" . $date . "', " . $taskId . ", 'Sending', " . $employeeId . ", NULL, NULL, NULL)";

        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when assigning_1';

        // Mission 3: Change status from Available to Doing in table TASK
        $sql = "UPDATE task t SET t.status = 'Doing', t.assignDate = '" . $date . "' WHERE t.task_id = " . $taskId;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when assigning_2';
        // echo 'Saothe troi';
        return true;
    }

    public function getTasksNotCompleted()
    {
        $sql = 'SELECT * FROM task WHERE task.status = "Available"';
        $result = $this->conn->query($sql);
        $taskList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $taskList;
    }

    public function getAllTasks()
    {
        $sql = 'SELECT * FROM task';
        $result = $this->conn->query($sql);
        $taskList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $taskList;
    }

    public function getTaskNameByTaskId($id)
    {
        $sql = 'SELECT * FROM task WHERE task.task_id = ' . $id;
        $result = $this->conn->query($sql);
        $task = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $task;
    }

    public function getAssignmentList()
    {
        $sql = 'SELECT * FROM assignment';
        $result = $this->conn->query($sql);
        $assignmentList = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $assignmentList;
    }

    public function getTaskByEmployeeId($employeeId)
    {
        $sql = 'SELECT task.name FROM task INNER JOIN assignment ON task.task_id = assignment.task_id WHERE assignment.receiver_id =  "' . $employeeId . '"';
        // echo 'sql: ', $sql;
        $result = $this->conn->query($sql);
        $taskNamePrivate = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $taskNamePrivate;
    }

    public function getTaskDoneByEmployeeId($employeeId)
    {
        $sql = 'SELECT task.name FROM task INNER JOIN assignment ON task.task_id = assignment.task_id WHERE assignment.receiver_id =  ' . $employeeId . ' AND assignment.task_status = "Done"';
        // echo 'sql: ', $sql;
        $result = $this->conn->query($sql);
        $taskNamePrivate = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $taskNamePrivate;
    }

    public function getTaskOnDoingByEmployeeId($employeeId)
    {
        $sql = 'SELECT task.name FROM task INNER JOIN assignment ON task.task_id = assignment.task_id WHERE assignment.receiver_id =  ' . $employeeId . ' AND (assignment.task_status = "Sending" OR assignment.task_status = "Submit")';
        // echo 'sql: ', $sql;
        $result = $this->conn->query($sql);
        $taskNamePrivate = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $taskNamePrivate;
    }

    public function getTasksReceiveByEmployeeId($employeeId)
    {
        // $sql = 'SELECT * FROM task INNER JOIN assignment ON assignment.task_id = task.task_id WHERE assignment.receiver_id = ' . $employeeId;
        $sql = 'SELECT * FROM task INNER JOIN assignment ON assignment.task_id = task.task_id WHERE assignment.receiver_id = ' . $employeeId . ' AND assignment.task_status = "Sending"';
        // echo 'result: ' . $sql;
        $result = $this->conn->query($sql);
        $listTask = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $listTask;
    }
    public function getTaskResultByAdminId($adminId)
    {
        $sql = 'SELECT * FROM task INNER JOIN assignment ON assignment.task_id = task.task_id WHERE assignment.sender_id = ' . $adminId . ' AND assignment.task_status = "Submit"';
        // echo $sql;
        $result = $this->conn->query($sql);
        $listTask = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $listTask;
    }

    public function getHistoryAssignmentByAdminId($adminId)
    {
        $sql = 'SELECT * FROM task INNER JOIN assignment ON assignment.task_id = task.task_id WHERE assignment.sender_id = ' . $adminId;
        // echo $sql;
        $result = $this->conn->query($sql);
        $listTask = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $listTask;
    }

    public function getAllHistory()
    {
        $sql = 'SELECT * FROM task INNER JOIN assignment ON assignment.task_id = task.task_id';
        // echo $sql;
        $result = $this->conn->query($sql);
        $listTask = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $listTask;
    }

    public function submitProcessing_($submitId, $resultInText)
    {
        $sql = "UPDATE assignment asm
        SET asm.task_status = 'Submit', asm.result = '" . $resultInText . "' WHERE asm.submit_id = " . $submitId;
        // echo $sql;  
        $result = $this->conn->query($sql);
        // return $result;
        if ($result === TRUE) {
            echo "Update oke";
        } else {
            echo 'fault when updating';
        }
    }

    public function approve_($submit_id, $_taskId_)
    {
        // Mission 1: update table Assignment
        $sql = "UPDATE assignment asm SET asm.task_status = 'Done' WHERE asm.submit_id = " . $submit_id;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_3';

        // Mission 2: update table Task
        $sql = "UPDATE task t SET t.status = 'Done' WHERE t.task_id = " . $_taskId_;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_4';
    }

    public function reject_($submit_id, $_taskId_)
    {
        $sql = "UPDATE assignment asm SET asm.task_status = 'Reject' WHERE asm.submit_id = " . $submit_id;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_5';

        // Mission 2: update table Task
        $sql = "UPDATE task t SET t.status = 'Available' WHERE t.task_id = " . $_taskId_;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_6';
    }

    public function getDepartmentNameById($id)
    {
        $sql = 'SELECT d.name FROM department d WHERE d.department_id = ' . $id;
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }

    public function getDepartmentHeadByDepartmentId($id)
    {
        $sql = 'SELECT e.name FROM employee e WHERE e.role = "head" AND e.department_id = ' . $id;
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }

    public function getDepartments()
    {
        $sql = 'SELECT * FROM department';
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }

    public function getEmloyees()
    {
        $sql = 'SELECT * FROM employee';
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }

    public function updateDepartmentById($id, $newDepartmentName, $newHeadName, $newNotes)
    {
        $sql = "UPDATE department d SET d.name ='" . $newDepartmentName . "', d.note = '" . $newNotes . "' WHERE d.department_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_7';

        $sql = "UPDATE employee e SET e.role = 'head', e.department_id = " . $id . " WHERE e.name = '" . $newHeadName . "'";
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_8';
    }

    public function isHeadInAnotherDepartment($name)
    {
        $sql = 'SELECT e.role FROM employee e WHERE e.name = "' . $name . '";';
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($res[0]['role'] == 'head') return true;
        return false;
    }

    public function removeHeadPositionByDepartmentId($id)
    {
        $sql = "UPDATE employee e SET e.role = 'employee', e.level = 3 WHERE e.department_id = " . $id;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_9';
    }

    public function removeDepartmentById_($id)
    {
        $sql = "DELETE FROM department WHERE department.department_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when remove_1';
    }

    public function createDepartment_($name, $head, $note)
    {
        $date = date("d/m/Y");
        $sql = "INSERT INTO department (department_id, name, createdDate, note)
        VALUES (NULL, '" . $name . "', '" . $date . "', '" . $note . "')";
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when insert_1';
    }

    public function updateTaskById($id, $name, $des, $dead)
    {
        $sql = "UPDATE task t SET t.name ='" . $name . "', t.description = '" . $des . "', t.deadline = '" . $dead . "' WHERE t.task_id = " . $id;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_10';
    }

    public function removeTaskById_($id)
    {
        $sql = "DELETE FROM task WHERE task.task_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when remove_2';
    }


    public function removeEmployeeById_($id)
    {
        $sql = "DELETE FROM employee WHERE employee.employee_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when remove_3';
    }

    public function createTask_($name, $des, $dead)
    {
        // echo 'test create task: ' . $name . $des . $dead;
        // $date = date("d/m/Y");
        // $sql = "INSERT INTO department (department_id, name, createdDate, note)
        // VALUES (NULL, '" . $name . "', '" . $date . "', '" . $note . "')";
        // // echo $sql;
        // $result = $this->conn->query($sql);
        // if ($result !== TRUE) echo 'Fault when insert_1';
        $date = date("d/m/Y");
        $sql = "INSERT INTO task (task_id, name, description, createdDate, deadline, assignDate, submitDate, status)
        VALUES (NULL, '" . $name . "', '" . $des . "', '" . $date . "', '" . $dead . "' , NULL, NULL, 'Available')";
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when insert_3';
    }

    public function newLevelById_($id, $newLevel)
    {
        $sql = "UPDATE employee e SET e.level = " . $newLevel . " WHERE e.employee_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_11';
    }

    public function checkExistEmployeeById($id)
    {
        $sql = 'SELECT * FROM employee WHERE employee.employee_id = ' . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result->num_rows) return true;
        return false;
    }

    public function getEmployeeNameById($id)
    {
        $sql = 'SELECT * FROM employee WHERE employee.employee_id = ' . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }


    public function submitTaskByAssignee_($sender_id, $res, $des, $whichtask)
    { // Done
        // Mission: add data in to table assignment
        $date = date("d/m/Y");
        $sql = "UPDATE assignment a SET a.task_status = 'Submit', a.des_when_submit = '" . $des . "', a.date_submit = '" . $date . "', a.result = '" . $res . "' WHERE a.sender_id = " . $sender_id . " AND a.receiver_id = " . $_SESSION['current_user_id'] . " AND a.task_id = " . $whichtask;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_12';
    }

    public function createEmployee_($fullname, $username)
    {
        $date = date("d/m/Y");
        $sql = "INSERT INTO employee (employee_id, department_id, role, name, username, password, level)
        VALUES (NULL, NULL, 'employee', '" . $fullname . "', '" . $username . "', '" . $username . "', 1)";
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when insert_4';
    }

    public function getCurrentIdDeparmentByUserId()
    {
        $sql = 'SELECT * FROM employee WHERE employee.employee_id = ' . $_SESSION['current_user_id'];
        // echo $sql;
        $result = $this->conn->query($sql);
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $res;
    }

    public function canPick($id)
    {
        $sql = 'SELECT * FROM employee WHERE employee.employee_id = ' . $id . ' AND employee.role = "employee"';
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result->num_rows) return true;
        return false;
    }

    public function pickEmployee_($id)
    {
        // return $this->canPick($id);
        if ($this->canPick($id) == false) return false;

        $currentDepartmentId = $this->getCurrentIdDeparmentByUserId()[0]['department_id'];
        $sql = "UPDATE employee e SET e.department_id = " . $currentDepartmentId . " WHERE e.employee_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) {
            echo 'Fault when updating_14';
            return false;
        }
        return true;
    }

    public function removeOut_($id)
    {
        $sql = "UPDATE employee e SET e.department_id = NULL WHERE e.employee_id = " . $id;
        // echo $sql;
        $result = $this->conn->query($sql);
        if ($result !== TRUE) echo 'Fault when updating_15';
    }
}
