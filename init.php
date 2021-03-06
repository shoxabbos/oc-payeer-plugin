<?php
use RainLab\User\Models\User as UserModel;
use Shohabbos\Payeer\Models\Transaction;
use Shohabbos\Pixel\Models\Settings;
use Shohabbos\Payeer\Models\Settings as PayeerSettings;

Event::listen('shohabbos.payeer.existsAccount', function ($id, &$result) {
	// find order or account
	$result = UserModel::find($id);
});


Event::listen('shohabbos.payeer.checkAmount', function ($amount, $currency, &$result) {
	// check amount
});

Event::listen('shohabbos.payeer.saveTransaction', function ($postData) {
	// save transaction
    $transaction = new Transaction();
	$transaction->m_operation_id = $_POST['m_operation_id'];
	$transaction->m_operation_ps = $_POST['m_operation_ps'];
	$transaction->m_operation_date = $_POST['m_operation_date'];
	$transaction->m_operation_pay_date = $_POST['m_operation_pay_date'];
	$transaction->m_shop = $_POST['m_shop'];
	$transaction->m_orderid = $_POST['m_orderid'];
	$transaction->m_amount = $_POST['m_amount'];
	$transaction->m_curr = $_POST['m_curr'];
	$transaction->m_desc = $_POST['m_desc'];
	$transaction->m_status = $_POST['m_status'];
	$transaction->save();
});

Event::listen('shohabbos.payeer.successPayment', function ($id, $amount, $currency) {
    // add balance or check order as paid
	$user = UserModel::find($id);
	$user->balance += (Settings::get('rate_'.PayeerSettings::get('currency')) * $amount);
	$user->save();
});