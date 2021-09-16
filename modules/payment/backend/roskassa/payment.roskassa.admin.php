<?php

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/includes/404.php';
}

class Payment_roskassa_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'Roskassa',
			"params" => array(
                'm_url' => 'URL мерчанта (по умолчанию https://pay.roskassa.net/form/)',
                'm_shop' => 'ID магазина',
                'm_key1' => 'Cекретный ключ',
                'test_mode' => array(
                    'name' => 'Тестовый режим',
                    'type' => 'checkbox',
                    'value' => 1,
                ),
				'roskassa_emailerr' => 'Email для ошибок оплаты'
			)
		);
	}
}