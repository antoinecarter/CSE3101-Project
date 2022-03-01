<?php
ob_start();
session_start();
$usercontroller = new UsersController();
$attendancecontroller = new AttendanceController();
$compyearcontroller = new CompyearController();
$departmentscontroller = new DepartmentsController();
$worklocationscontroller = new WorklocationsController();
$unitscontroller = new UnitsController();
$timeclockscontroller = new TimeclocksController();
$shiftscontroller = new ShiftsController();
$referencescontroller = new ReferencesController();
$salarycontroller = new SalaryController();
$positionscontroller = new PositionsController();
$payperiodscontroller = new PayperiodsController();
$organizationscontroller = new OrganizationsController();
$leaverequestscontroller = new LeaverequestsController();
$leaveentitlemtcontroller = new LeaveentitlemtController();
$individualscontroller = new IndividualsController();
$employeescontroller = new EmployeesController();

?>