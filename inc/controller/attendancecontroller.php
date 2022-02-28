<?php

include_once __DIR__ . "/../model/tables/attendance.php";
include_once __DIR__ . "/../alert.php";

class AttendanceController extends attendance
{
    private $attendanceModel;
    public $message;

    public function __construct()
    {
        $this->attendanceModel = new attendance();
    }

    public function create($d)
    {
        
    }

    public function delete($id)
    {
        
    }

    public function view($role, $id)
    {
        
    }

    public function update($id, $d)
    {
        
    }
}
?>