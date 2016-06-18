<?php

class CartController extends Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        //This method contains all the shopping cart functions - add , delete , update products

        if(!($_SESSION['user'])) {
            header('Location: index.php?c=dashboard&m=index');
        }

        $data = array();

        $gameCollection = new GamesCollection();
        //Filter id
        $game_id = $this->cleanSubmitInput($_GET['id']);
        $game = $gameCollection->getSingleGame($game_id);

        if(!empty($_GET['action'])) {
            switch($_GET['action']) {
                //add products to the cart
                case 'add':
                    if(!empty($_POST['quantity'])) {
                        $productById = $game;
                        $itemArray = array(

                            $productById->getId() =>

                                array(
                                    'image' => $productById->getImage(),
                                    'category_name' => $productById->getCategoryId(),
                                    'name'=>$productById->getNameId(),
                                    'id'=>$productById->getId(),
                                    'quantity'=>$_POST['quantity'],
                                    'price'=>$productById->getPrice()
                                )
                        );

                        if(!empty($_SESSION['cart_item'])) {
                            if(in_array($productById->getId(),$_SESSION['cart_item'])) {
                                foreach($_SESSION['cart_item'] as $key => $value) {
                                    if($productById->getId() == $key)
                                        $_SESSION['cart_item'][$key]['quantity'] = $_POST['quantity'];
                                }
                            } else {
                                $_SESSION['cart_item'] = array_replace($_SESSION['cart_item'],$itemArray);
                            }
                        } else {
                            $_SESSION['cart_item'] = $itemArray;
                        }
                    }
                    break;
                // remove products from the cart
                case 'remove':
                    if(!empty($_SESSION['cart_item'])) {
                        foreach($_SESSION['cart_item'] as $key => $value) {
                            if($_GET['id'] == $key)
                                unset($_SESSION['cart_item'][$key]);
                            if(empty($_SESSION['cart_item']))
                                unset($_SESSION['cart_item']);
                        }
                    }
                    break;
                //empty shopping cart
                case 'empty':
                    header("Location:index.php?c=cart&m=emptyCart");
                    unset($_SESSION['cart_item']);
                    break;
            }
        }
        //Pass data to the view
        $data['game'] = $game;
        //Load shopping cart view
        $this->loadFrontView('shopping_cart/show_cart', $data);

    }

    public function notify() {

        $this->loadFrontView('shopping_cart/notify');
    }

    public function emptyCart() {
        //View to be shown after emptying the shopping cart
       $this->loadFrontView('shopping_cart/empty');
  }

   public function checkout() {

       //Checkout operation
       if(empty($_SESSION['cart_item'])) {
           header('Location: index.php?c=dashboard&m=index');
       }

       $data = array();

       $insertInfo = array(
           'customer_phone' => '',
           'customer_address' => '',
           'customer_email' => '',
       );

       $errors = array();

       $itemsArray = [];
       $finalArray = [];
       $additionalInfoArray = [];
       $fillterArray = array();

       if(isset($_POST['submit'])) {

            $insertInfo = array(
                'customer_phone' => (isset($_POST['phone']))? $this->cleanSubmitInput($_POST['phone']) : '',
                'customer_address' => (isset($_POST['address']))? $this->cleanSubmitInput($_POST['address']) : '',
                'customer_email' => (isset($_POST['email']))? $this->cleanSubmitInput($_POST['email']) : '',
                'payment_method' => $_POST['paymentMethod'],
                'shipping' => isset($_SESSION['shipping_status'])? $_SESSION['shipping_status'] : ''
            );

            //Filter again
            $fillterArray = $this->cleanFinalInput($insertInfo);
            //Validate filtered data
            $errors = $this->validateUserInput($insertInfo);

            //Extract product/s name , quantity , category & price from $_SESSION['cart_item']
            // using array_column() function
            $itemsArray = $_SESSION['cart_item'];
            $names = array_column($itemsArray,'name');
            $quantities = array_column($itemsArray,'quantity');
            $categories = array_column($itemsArray,'category_name');
            $prices = array_column($itemsArray,'price');

            // Use implode to store the string representation of all array elements in arrays $names , $quantities , $categories , $prices
            $names = implode(',',$names).' ';
            $categories = implode(',',$categories).' ';
            $prices = implode(',',$prices).' ';
            $quantities = implode(',',$quantities).' ';

            //fill final arrays to be inserted in db
            //1)Array 1
            $finalArray['order_info'] = $names.$categories.$quantities.$prices;
            $finalArray['order_amount'] = $_SESSION['item_total'];
            $finalArray['customer_username'] = $_SESSION['user']->getUsername();
            $finalArray['order_ID'] = sha1(rand(0,50));
            $finalArray['order_date'] = date("Y-m-d H:i:s");
            $finalArray['status'] = 'New';

            //2)Array 2
           $additionalInfoArray = $fillterArray;

            if(empty($errors)) {

                $orderEntity = new OrdersEntity();
                $orderEntity->setOrderID($finalArray['order_ID']);
                $orderEntity->setCustomerUsername($finalArray['customer_username']);
                $orderEntity->setOrderInfo($finalArray['order_info']);
                $orderEntity->setOrderAmount($finalArray['order_amount']);
                $orderEntity->setShipping($additionalInfoArray['shipping']);
                $orderEntity->setCustomerPhone($additionalInfoArray['customer_phone']);
                $orderEntity->setCustomerAddress($additionalInfoArray['customer_address']);
                $orderEntity->setCustomerEmail($additionalInfoArray['customer_email']);
                $orderEntity->setPaymentMethod($additionalInfoArray['payment_method']);
                $orderEntity->setOrderDate($finalArray['order_date']);
                $orderEntity->setStatus($finalArray['status']);
                $this->sendOrderEmail(
                    $finalArray['customer_username'],$finalArray['order_ID'],$finalArray['order_info'],
                    $additionalInfoArray['customer_address'],$additionalInfoArray['customer_email'],
                    $additionalInfoArray['customer_phone'],$finalArray['order_amount'],
                    $additionalInfoArray['payment_method'],$additionalInfoArray['shipping']
                );

                $collection = new OrdersCollection();
                //save() escapes data before inserting in db
                $collection->save($orderEntity);

                unset($_SESSION['cart_item']);
                unset($_SESSION['item_total']);
                unset($_SESSION['shipping_status']);

                header('Location:index.php?c=cart&m=success');
                exit;
            }
        }

        //Pass data to the view
        $data['errors'] = $errors;
        $data['insertInfo'] = $insertInfo;

       //Load view checkout.php from folder shopping_cart
        $this->loadFrontView('shopping_cart/checkout',$data);
}

    public function success() {
    //View to be shown after successful checkout
     $this->loadFrontView('shopping_cart/after_checkout');
   }

    private function validateUserInput($input)
    {
        $errors = array();

        if ( (empty($input['customer_phone'])) || (strlen($input['customer_phone']) < 3) || (!ctype_digit($input['customer_phone'])) ) {
            $errors['customer_phone'] = 'Incorrect phone number! Did you fill in the field!';
        }


        if ( (empty($input['customer_email'])) || (strlen($input['customer_email']) > 100) || (!filter_var($input['customer_email'], FILTER_VALIDATE_EMAIL)) ) {
            $errors['customer_email'] = 'Incorrect email format! Did you fill in the field!';
        }

        if ( (empty($input['customer_address'])) || (strlen($input['customer_address']) < 3) || (strlen($input['customer_address']) > 100 ) ) {
            $errors['customer_address'] = 'Incorrect address! Did you fill in the field!';
        }


        return $errors;
    }

    private function cleanFinalInput($input) {
        $filterkeys = array_map('trim',array_keys($input));
        $filtervalues = array_map('trim',$input);
        $input = array_combine($filterkeys,$filtervalues);
        $input = array_map('stripslashes',$input);
        $input = array_map('htmlentities',$input);
        return $input;
    }

    private function cleanSubmitInput($input) {

        $input = stripslashes(htmlentities(trim($input)));
        return $input;
    }

    //Send email containing the order's details
    private function sendOrderEmail($username,$orderNumber,$orderOverview,$customerAddress,$email,$customerPhone,$orderAmount,$paymentMethod,$shipping) {
        $to      = $email; // Send email to our user
        $subject = 'Order Details'; // Give the email a subject
        $fee = '';

        if($shipping == 1) {
            $fee .= 'Shipping: + 20$';
        }

        else {
            $fee .= 'No Shipping fees !';
        }


        $message = '

        Thank you for choosing us!
        Below are listed all the details of your order.
        If you have any questions please contact us immediately.

        ------------------------
        Username: '.$username.'
        Order number: '.$orderNumber.'
        Order overview: '.$orderOverview.'
        Customer address: '.$customerAddress.'
        Customer phone:  '.$customerPhone.'
        Payment method:  '.$paymentMethod.'
        Shipping Fees: '.$fee.'
        Total Order Amount:  $'.$orderAmount.'
        ';


        $headers = 'From:noreply@GamesCorner.com' . "\r\n"; // Set from headers
        $mail = mail($to, $subject, $message, $headers); // Send our email

        return $mail;
    }
}