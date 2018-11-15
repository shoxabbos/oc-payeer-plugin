<?php namespace Shohabbos\Payeer\Controllers;

use Event;
use Illuminate\Routing\Controller;
use Shohabbos\Payeer\Models\Settings;
use Shohabbos\Payeer\Models\Transaction;

class Payeer extends Controller
{

    public function index(\Illuminate\Http\Request $mainRequest) {

    	// check IP
    	$whitelist = ['185.71.65.92', '185.71.65.189', '149.202.17.210'];
    	if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            return "stop";
        }


    	// prepare data
    	$m_key = Settings::get("key");




    	// Is exists order or account
        $result = true;
        Event::fire('shohabbos.payeer.existsAccount', [$_POST['m_orderid'], &$result]);
        if (!$result) {
            exit($_POST['m_orderid'].'|error');
        }


        // Check amount
        $result = true;
        Event::fire('shohabbos.payeer.checkAmount', [$_POST['m_amount'], $_POST['m_curr'], &$result]);
        if (!$result) {
            exit($_POST['m_orderid'].'|error');
        }


        if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
            $arHash = array(
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status']
            );

            if (isset($_POST['m_params'])) {
                $arHash[] = $_POST['m_params'];
            }

            $arHash[] = $m_key;

            $sign = strtoupper(hash('sha256', implode(':', $arHash)));


            // Если подписи совпадают и статус платежа “Выполнен”
            if($_POST['m_sign'] == $sign && $_POST['m_status'] == 'success'){
            	Event::fire('shohabbos.payeer.saveTransaction', $_POST);

		        Event::fire('shohabbos.payeer.successPayment', [
		        	$_POST['m_orderid'],
		        	$_POST['m_amount'], 
		        	$_POST['m_curr'],
		        ]);

                exit($_POST['m_orderid'].'|success');
            }
        }

        // В противном случае возвращаем ошибку
        exit($_POST['m_orderid'].'|error');
    }


}
