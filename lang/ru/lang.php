<?php return [
    'plugin' => [
        'name' => 'Payeer',
        'description' => 'Payeer desc'
    ],
    'settings' => [
    	'label' => 'Настройки',
    	'description' => 'Управление параметрами  Payeer',
    	'tab_main' => 'Параметры',
    	'tab_code' => 'Бизнес логика',
    	'required_section' => 'Обязательные параметры',
    	'optional_section' => 'Необязательные параметры',
    	'shop_id' => 'Идентификатор мерчанта',
    	'shop_id_desc' => 'Идентификатор мерчанта зарегистрированного в системе Payeer на который будет совершен платеж',
    	'key' => 'Секретный ключ',
    	'key_desc' => 'Секретный ключ из настроек мерчанта Payeer',
    	'add_key' => 'Ключ для шифрования дополнительных параметров',
    	'currency' => 'Валюта платежа',
    	'currency_desc' => 'Возможные валюты: USD, EUR, RUB',
    	'status_url' => 'URL обработчика',
    	'success_url' => 'URL успешной оплаты',
    	'fail_url' => 'URL неуспешной оплаты',
    	'code' => 'Events (init.php)',
    	'code_desc' => 'Вы можете расширить функционал плагина с помощью событий или настроить под себя.',
    	'reference' => 'Дополнительные параметры',
    	'field_key' => 'Key',
    	'field_value' => 'Value',
    ],
    'transactions' => [
        'title' => 'Транзакции',
        'description' => 'Список транзакций'
    ],
    'payform' => [
        'name' => 'Форма оплаты',
        'description' => 'Создает форму с кнопкой оплатить',
        'amount_param' => 'Параметр суммы',
        'amount_param_desc' => 'Параметр суммы с помощью которого будет передаваться сумма',
        'order_param' => 'Заказ / ID пользователя',
        'order_param_desc' => 'Номер заказа или ID пользователя'
    ],
];