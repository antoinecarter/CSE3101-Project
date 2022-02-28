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


    public function tblattendance()
    {
        include_once __DIR__ . "/../view/tblattendance.php";
    }

    public function frmattendance()
    {
        include_once __DIR__ . "/../view/frmattendance.php";
    }

    public function edtattendance()
    {
        include_once __DIR__ . "/../view/edtattendance.php";
    }

    public function delattendance(){
        include_once __DIR__ . "/../view/delete.php";
    }

    public function createatt($d)
    {
        
    }

    public function deleteatt($id)
    {
        
    }

    public function viewatt($role, $id)
    {
        
    }

    public function updateatt($id, $d)
    {
        
    }
}
?>