<?php


class Payments extends Controller
{
    public function __construct()
    {
        $this->paymentModel = $this->model('Payment');
    }
    public function payment()
    {
        $this->view('payments/payment');
        if(isset($_POST['pay'])){
            $method = $_POST('');
            $this->paymentModel->placeOrder();
        }
    }
    public function info(){
        $this->view('payments/info');
    }
}