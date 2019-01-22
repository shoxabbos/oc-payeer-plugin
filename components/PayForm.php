<?php namespace Shohabbos\Payeer\Components;

use Input;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Shohabbos\Payeer\Models\Settings;

/**
 * User session
 *
 * This will inject the user object to every page and provide the ability for
 * the user to sign out. This can also be used to restrict access to pages.
 */
class PayForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'shohabbos.payeer::lang.payform.name',
            'description' => 'shohabbos.payeer::lang.payform.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'paramAmount' => [
                'title'       => 'shohabbos.payeer::lang.payform.amount_param',
                'description' => 'shohabbos.payeer::lang.payform.amount_param_desc',
                'type'        => 'string',
                'default'     => 'amount'
            ],
            'paramOrder' => [
                'title'       => 'shohabbos.payeer::lang.payform.order_param',
                'description' => 'shohabbos.payeer::lang.payform.order_param_desc',
                'type'        => 'string',
                'default'     => 'order_id'
            ],
        ];
    }

    public function onPayForm()
    {
        $paramAmount = $this->property('paramAmount');
        $paramOrder = $this->property('paramOrder');

        $data = Input::only([$paramAmount, $paramOrder]);

        $validator = Validator::make($data, [
            $paramOrder => 'required',
            $paramAmount => 'required|numeric|max:1000',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $amount = $data[$paramAmount];
        $order = $data[$paramOrder];

        $m_shop = Settings::get('shop_id');
        $m_orderid = $order;
        $m_amount = number_format($amount, 2, '.', '');
        $m_curr = Settings::get('currency');
        $m_desc = base64_encode('(Order / User) ID: '.$amount);
        $m_key = Settings::get('key');
        
        $arHash = [$m_shop, $m_orderid, $m_amount, $m_curr, $m_desc];

        $arHash[] = $m_key;
        $m_sign = strtoupper(hash('sha256', implode(':', $arHash)));
        
        // prepare data
        $this->page['m_shop'] = $m_shop;
        $this->page['m_orderid'] = $m_orderid;
        $this->page['m_amount'] = $m_amount;
        $this->page['m_curr'] = $m_curr;
        $this->page['m_desc'] = $m_desc;
        $this->page['m_sign'] = $m_sign;
    }


    
}
