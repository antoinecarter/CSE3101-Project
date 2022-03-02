<?php
ob_start();
session_start();
$usercontroller = new UsersController();
$absencecontroller = new AbsenceController();
$addresscontroller = new AddressController();
$attendancecontroller = new AttendanceController();
$compyearcontroller = new CompyearController();
$departmentscontroller = new DepartmentsController();
$latenesscontroller = new LatenessController();
$leavetrackcontroller = new LeavetrackController();
$orgstructurecontroller = new OrgstructureController();
$worklocationscontroller = new WorklocationsController();
$unitscontroller = new UnitsController();
$timeclockscontroller = new TimeclocksController();
$shiftscontroller = new ShiftsController();
$referencescontroller = new ReferencesController();
$nationalidentifierscontroller = new NationalidentifiersController();
$salarycontroller = new SalaryController();
$positionscontroller = new PositionsController();
$organizationscontroller = new OrganizationsController();
$leaverequestscontroller = new LeaverequestsController();
$leaveentitlemtcontroller = new LeaveentitlemtController();
$individualscontroller = new IndividualsController();
$employeescontroller = new EmployeesController();

?>