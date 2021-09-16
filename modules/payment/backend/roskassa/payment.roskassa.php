<?php

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/includes/404.php';
}

if (empty($_REQUEST['order_id']))
{
	Custom::inc('includes/404.php');
}

if ($_GET["rewrite"] == "roskassa/result")
{
	if (isset($_REQUEST["intid"]) && isset($_REQUEST["SIGN"]))
	{
		$err = false;
		$message = '';
		$pay = $this->diafan->_payment->check_pay($_REQUEST['order_id'], 'roskassa');






		
		if (!$err)
		{
			$order_amount = number_format($pay['summ'], 2, '.', '');
			
			// проверка суммы
		
			if ($_REQUEST['AMOUNT'] != $order_amount)
			{
				$message .= " - неправильная сумма\n";
				$err = true;
			}


		}
		
		if ($err)
		{
			$to = $pay['params']['roskassa_emailerr'];

			if (!empty($to))
			{
				$message = "Не удалось провести платёж через систему RosKassa по следующим причинам:\n\n" . $message . "\n" ;
				$headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n" . 
				"Content-type: text/plain; charset=utf-8 \r\n";
				mail($to, 'Ошибка оплаты', $message, $headers);
			}
			
			exit ($_REQUEST['order_id'] . ' | error | ' . $message);
		}
		else
		{
			exit ('YES');
		}
	}
}

if ($_GET["rewrite"] == "roskassa/success")
{
	$order_id = $_REQUEST['order_id'];

    $pay = $this->diafan->_payment->check_pay($order_id, 'roskassa');
	$this->diafan->_payment->success($pay, 'redirect');
}

if ($_GET["rewrite"] == "roskassa/fail")
{
    $order_id = $_REQUEST['order_id'];
	$pay = $this->diafan->_payment->check_pay($order_id, 'roskassa');
	$this->diafan->_payment->fail($pay);
}

