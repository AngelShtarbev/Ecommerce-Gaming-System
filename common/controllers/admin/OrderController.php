<?php

class OrderController extends Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        //This method outputs all the information for all orders in the database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        //Filter value of $search variable
        $clean = $this->cleanInput($search);
        //$like variable is used in search filter
        //used in pagination
        if ( ($clean) != '') {
            $like = array('customer_username', $clean);
        } else {
            $like = array();
        }

        //$perPageSelect variable is used to filter the number of orders per page
        //also used in pagination
        $perPageSelect = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 0;
        switch ($perPageSelect) {
            case 0:
                $perPage = 10;
                break;
            case 1:
                $perPage = 5;
                break;
            case 2:
                $perPage = 10;
                break;
            case 3:
                $perPage = 20;
                break;
            case 4:
                $perPage = 50;
                break;
            default:
                $perPage = 10;
        }

        //$orderBy variable is used to filter the orders by customer_username , order_amount , shipping , customer_phone , customer_email and order_id
        //also used in pagination
        $orderBy = (isset($_GET['orderBy'])) ? (int)$_GET['orderBy'] : 0;
        switch ($orderBy) {
            case 0:
                $order = array('id', 'DESC');
                break;
            case 1:
                $order = array('customer_username', 'ASC');
                break;
            case 2:
                $order = array('customer_username', 'DESC');
                break;
            case 3:
                $order = array('order_amount', 'ASC');
                break;
            case 4:
                $order = array('order_amount', 'DESC');
                break;
            case 5:
                $order = array('shipping', 'ASC');
                break;
            case 6:
                $order = array('shipping', 'DESC');
                break;
            case 7:
                $order = array('customer_phone', 'ASC');
                break;
            case 8:
                $order = array('customer_phone', 'DESC');
                break;
            case 9:
                $order = array('customer_email', 'ASC');
                break;
            case 10:
                $order = array('customer_email', 'DESC');
                break;
            case 11:
                $order = array('order_date', 'ASC');
                break;
            case 12:
                $order = array('order_date', 'DESC');
                break;
            default:
                $order = array('id', 'DESC');
        }

        //$page is used to determine what page number is selected
        $page = isset($_GET['page'])? (int)$_GET['page'] : 1;
        //$offset is used to determine the number of orders to be shown per page
        $offset  = ($page) ? ($page-1) * $perPage : 0;
        //Make an instance of OrdersCollection class
        $ordersCollection = new OrdersCollection();
        //Use getAll() method to fetch all records for all orders using the filters $order & $like
        $rows = (count($ordersCollection->getAll(array(), -1, 0, $order, $like)) == 0)? 1 : count($ordersCollection->getAll(array(), -1, 0, $order, $like));
        //Make an instance of Pagination class
        $pagination = new Pagination();
        //Use setPerPage() method to determine the number of the page
        $pagination->setPerPage($perPage);
        // Use setTotalRows() method to determine the number of orders per page
        $pagination->setTotalRows($rows);
        // Use setBaseUrl() method to determine the url for every page
        $pagination->setBaseUrl("http://localhost/ProjectCourseMVCNew/admin/index.php?c=order&m=index&perPage={$perPageSelect}&orderBy={$orderBy}&search=$clean");

        // Use getAll() method to fetch all records for all orders from the database using all of the defined filters
        $orders = $ordersCollection->getAll(array(), $offset, $perPage, $order, $like);

        // Pass all information to the view using the associative array $data
        $data['orders'] = $orders;
        $data['pagination'] = $pagination;
        $data['clean'] = $clean;
        $data['perPageSelect'] = $perPageSelect;
        $data['orderBy'] = $orderBy;
        $data['page'] = $page;

        //Load view listing.php from folder orders
        $this->loadView('orders/listing', $data);

    }

    public function create() {

        //This method is used to create orders

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //Create array $data and pass it to the view
        $data = array();

        //Create array $insertInfo and pass it to the view
        $insertInfo = array(
            'customer_username' => '',
            'order_info' => '',
            'order_amount' => '',
            'shipping' => '',
            'customer_phone' => '',
            'customer_address' => '',
            'customer_email'=> '',
            'payment_method' => '',
            'order_date' => '',
            'status' => '',

        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        //When the form in the view is submitted
        if (isset($_POST['createOrder'])) {

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method
            $insertInfo = array(
                'order_ID' => sha1(rand(0,50)),
                'customer_username' => (isset($_POST['username']))? $this->cleanInput($_POST['username']) : '',
                'order_info' => (isset($_POST['order_info']))? $this->cleanInput($_POST['order_info']) : '',
                'order_amount' => (isset($_POST['order_amount']))? $this->cleanInput($_POST['order_amount']) : '',
                'shipping' => (isset($_POST['shipping']))? $this->cleanInput($_POST['shipping']) : '',
                'customer_phone' => (isset($_POST['phone']))? $this->cleanInput($_POST['phone']) : '',
                'customer_address' => (isset($_POST['address']))? $this->cleanInput($_POST['address']) : '',
                'customer_email' => (isset($_POST['email']))? $this->cleanInput($_POST['email']) : '',
                'payment_method' => (isset($_POST['payment_method']))? $this->cleanInput($_POST['payment_method']) : '',
                'status' => (isset($_POST['order_status']))? $this->cleanInput($_POST['order_status']) : '',
                'order_date' => date("Y-m-d H:i:s"),

            );

            //After all the input information is filtered it is validated
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors insert in database
            if (empty($errors)) {

                $ordersEntity = new OrdersEntity();
                $ordersEntity->setOrderID($insertInfo['order_ID']);
                $ordersEntity->setCustomerUsername($insertInfo['customer_username']);
                $ordersEntity->setOrderInfo($insertInfo['order_info']);
                $ordersEntity->setOrderAmount($insertInfo['order_amount']);
                $ordersEntity->setShipping($insertInfo['shipping']);
                $ordersEntity->setCustomerPhone($insertInfo['customer_phone']);
                $ordersEntity->setCustomerAddress($insertInfo['customer_address']);
                $ordersEntity->setCustomerEmail($insertInfo['customer_email']);
                $ordersEntity->setPaymentMethod($insertInfo['payment_method']);
                $ordersEntity->setOrderDate($insertInfo['order_date']);
                $ordersEntity->setStatus($insertInfo['status']);

                $collection = new OrdersCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($ordersEntity);

                $_SESSION['flashMessage'] = 'You have 1 new order';
                header("Location: index.php?c=order&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        // Load view create.php from folder orders
        $this->loadView('orders/create', $data);

    }

    public function update() {
        // This method is used to update orders information

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        // If no game id is provided for the update operation redirect
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=order&m=index');
        }

        //Create array $data and pass it to the view
        $data = array();
        //Filter id sent by $_GET
        $clean = $this->cleanInput($_GET['id']);

        //Fetch all records for an order by id
        $ordersCollection = new OrdersCollection();
        $orders = $ordersCollection->getOne($clean);

        //If no records are fetched for an order redirect
        if (is_null($orders)) {
            header('Location: index.php?c=order&m=index');
        }

        //Create array $insertInfo and pass it to the view
        //It is used for all inputs in the view
        $insertInfo = array(
            'order_ID'=> $orders->getOrderID(),
            'customer_username' => $orders->getCustomerUsername(),
            'order_info' => $orders->getOrderInfo(),
            'order_amount' => $orders->getOrderAmount(),
            'shipping' => $orders->getShipping(),
            'customer_phone' => $orders->getCustomerPhone(),
            'customer_address' => $orders->getCustomerAddress(),
            'customer_email'=> $orders->getCustomerEmail(),
        );

        //Create array $errors and pass it to the view
        //It is used to output all the errors for the validation of all inputs
        $errors = array();

        if (isset($_POST['editOrder'])) {

            //Fetch all input information and store it in array $insertInfo
            //Filter all the input information using cleanInput() method

            $insertInfo = array(
                'order_ID' => sha1(rand(0,50)),
                'customer_username' => (isset($_POST['username']))? $this->cleanInput($_POST['username']) : '',
                'order_info' => (isset($_POST['order_info']))? $this->cleanInput($_POST['order_info']) : '',
                'order_amount' => (isset($_POST['order_amount']))? $this->cleanInput($_POST['order_amount']) : '',
                'shipping' => (isset($_POST['shipping']))? ($_POST['shipping']) : '',
                'customer_phone' => (isset($_POST['phone']))? $this->cleanInput($_POST['phone']) : '',
                'customer_address' => (isset($_POST['address']))? $this->cleanInput($_POST['address']) : '',
                'customer_email' => (isset($_POST['email']))? $this->cleanInput($_POST['email']) : '',
                'payment_method' => (isset($_POST['payment_method']))? $this->cleanInput($_POST['payment_method']) : '',
                'status' => (isset($_POST['order_status']))? $this->cleanInput($_POST['order_status']) : '',
                'order_date' => date("Y-m-d H:i:s"),

            );

            //Validate filtered information
            $errors = $this->validateUserInput($insertInfo);

            //If there are no validation errors update all records for a game in the database
            //If ids are not passed to the save method a new insert in all tables will occur instead of an update operation
            if (empty($errors)) {
                //Filter id sent by $_GET
                $clean = $this->cleanInput($_GET['id']);

                $ordersEntity = new OrdersEntity();
                $ordersEntity->setId($clean);
                $ordersEntity->setOrderID($insertInfo['order_ID']);
                $ordersEntity->setCustomerUsername($insertInfo['customer_username']);
                $ordersEntity->setOrderInfo($insertInfo['order_info']);
                $ordersEntity->setOrderAmount($insertInfo['order_amount']);
                $ordersEntity->setShipping($insertInfo['shipping']);
                $ordersEntity->setCustomerPhone($insertInfo['customer_phone']);
                $ordersEntity->setCustomerAddress($insertInfo['customer_address']);
                $ordersEntity->setCustomerEmail($insertInfo['customer_email']);
                $ordersEntity->setPaymentMethod($insertInfo['payment_method']);
                $ordersEntity->setOrderDate($insertInfo['order_date']);
                $ordersEntity->setStatus($insertInfo['status']);

                $collection = new OrdersCollection();
                //save() method escapes all data before inserting it in the database
                $collection->save($ordersEntity);

                $_SESSION['flashMessage'] = 'You have 1 affected row';
                header("Location: index.php?c=order&m=index");
            }
        }

        //Pass all data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

        //Load view update.php from folder games
        $this->loadView('orders/update', $data);
    }

    public function delete() {

        //This method is used to delete information for an order in database

        //If no log in is performed redirect to login page
        if (!$this->loggedIn()) {
            header('Location: index.php?c=login&m=login');
        }

        //If no order id is provided redirect to login page
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=order&m=index');
        }

        $clean = $this->cleanInput($_GET['id']);

        //Select row to be deleted from orders table
        $ordersCollection = new OrdersCollection();
        $order = $ordersCollection->getOne($clean);

        //Check for result query in  table $orders
        //If no records are fetched for a game redirect
        if (is_null($order)) {
            header('Location: index.php?c=order&m=index');
        }

        //delete records from table orders
        $ordersCollection->delete($order->getId());
        header('Location: index.php?c=order&m=index');
    }

    private function validateUserInput($input)
    {
        $errors = array();

        if ( (empty($input['customer_username'])) || (strlen($input['customer_username']) <= 3) || (strlen($input['customer_username']) >= 255) ) {
            $errors['customer_username'] = 'Incorrect name! Did you fill in the field!';
        }

        if ( (empty($input['order_info'])) || (strlen($input['order_info']) <= 3) || (strlen($input['order_info']) >= 255) ) {
            $errors['order_info'] = 'Incorrect order description! Did you fill in the field!';
        }

        if ( (empty($input['order_amount'])) || (!filter_var($input['order_amount'], FILTER_VALIDATE_FLOAT)) ) {
            $errors['order_amount'] = 'Incorrect format! Did you fill in the field!';
        }

        if ( (empty($input['customer_phone'])) || (strlen($input['customer_phone']) <= 3) || (strlen($input['customer_phone']) >= 100) || (!ctype_digit($input['customer_phone'])) ) {
            $errors['customer_phone'] = 'Incorrect format! Did you fill in the field!';
        }

        if ( (empty($input['customer_address'])) || (strlen($input['customer_address']) <= 3) || (strlen($input['customer_address']) >= 255) ) {
            $errors['customer_address'] = 'Incorrect address! Did you fill in the field!';
        }

        if ( (empty($input['customer_email'])) || (strlen($input['customer_email']) <= 3) || (!filter_var($input['customer_email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['customer_email'] = 'Incorrect format! Did you fill in the field!';
        }

        return $errors;
    }

    private function cleanInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }
}