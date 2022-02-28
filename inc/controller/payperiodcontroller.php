<?php


        include_once __DIR__ . "/../model/tables/payperiod.php";
        include_once __DIR__ . "/../alert.php";
        
        class PayperiodsController extends payperiods
        {
            private $payperiodsModel;
            public $message;
        
            public function __construct()
            {
                $this->payperiodsModel = new payperiods();
            }
        

            public function tblpayperiods()
            {
                include_once __DIR__ . "/../view/tblpayperiod.php";
            }
        
            public function frmpayperiods()
            {
                include_once __DIR__ . "/../view/frmpayperiod.php";
            }
        
            public function edtpayperiods()
            {
                include_once __DIR__ . "/../view/edtpayperiod.php";
            }
        
            public function delpayperiods(){
                include_once __DIR__ . "/../view/delete.php";
            }

    public function createpayp()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {
            include_once __DIR__ . "/../view/frmpayperiods.php";
        } else {
            if (empty($_POST['first_name'])) {
                $message = 'Please enter First name';
                return $message;
            }

            if (empty($_POST['last_name'])) {
                $message = 'Please enter Last name';
                return $message;
            }

            if (empty($_POST['start_date'])) {
                $message = 'Please input date ';
                return $message;
            }

            $new_payperiods = new payperiods();
            $new_payperiods->set_fname($_POST['first_name']);
            $new_payperiods->set_lname($_POST['last_name']);
            $new_payperiods->set_start_date($_POST['start_date']);
            $new_payperiods->create();
            $message = 'payperiods Created';
            return $message;
    }
    }

    public function deletepayp()
    {
        {
            if ($_SERVER['REQUEST_METHOD'] = 'POST') {
                $url = $_SERVER['REQUEST_SCHEME'] . '://';
                $url .= $_SERVER['HTTP_HOST'];
                $url .= $_SERVER['REQUEST_URI'];
    
                $url_components = parse_url($url);
                if(isset($url_components['query'])){
                    parse_str($url_components['query'], $params);
                }
                $id = $params['id'];
                $statement = $this->payperiodsModel->getPaypById($id);
                $delpayp = $statement->fetch(PDO::FETCH_ASSOC);
                if ($delpayp['id'] != $_SESSION['id']) {
                    if (($delpayp['role'] != 'ADMIN') && ($_SESSION['role'] == 'ADMIN')) {
                        $message = $this->payperiodsModel->delete($id);
                        $this->delpayp();
                        return $message;
                    } else {
                        $message = 'User is an Admin/You are not an Admin';
                        return $message;
                    }
                } else {
                    $message = 'Error! Cannot delete logged-in user';
                    return $message;
                }
            }
        }
    }

    public function viewpayp()
    {
        
        $url = $_SERVER['REQUEST_SCHEME'] . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];

        $url_components = parse_url($url);
        if(isset($url_components['query'])){
            parse_str($url_components['query'], $params);
        };
        $id = $params['id'];
        $payperiods = $this->payperiodsModel->getPaypById($id);
        return $payperiods;
    }

    public function viewpayps()
    {
        $id =  $_SESSION['id'];
        $role = $_SESSION['role'];
        $statement = $this->payperiodsModel->view($role, $id);
        return $statement;
    
    }

    public function updatepayp()
    {
    
            $update_payp = new payperiods();
            $d = array(
                'id'            => $_REQUEST['id'],
                'org_id'        => $_REQUEST['org_id'],
                'first_name'     => $_REQUEST['first_name'],
                'last_name'     => $_REQUEST['last_name'],
                'start_date'    => $_REQUEST['start_date'],
                'role'            => $_REQUEST['role'],
                'emp_no'        => $_REQUEST['emp_no']

            );
            $message = $update_payp->update($d['id'], $d);
            include_once __DIR__ . "/../view/edtpayperiods.php";
            return $message;
        }
    
}
?>