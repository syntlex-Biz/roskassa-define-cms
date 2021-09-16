<?php

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/includes/404.php';
}

class Payment_roskassa_model extends Diafan
{
	/**
     * Формирует данные для формы платежной системы RosKassa
     * 
     * @param array $params настройки платежной системы
     * @param array $pay данные о платеже
     * @return array
     */
	public function get($params, $pay)
	{
		$m_shop = $params['m_shop'];
		$m_orderid = $pay['id'];
		$m_amount = number_format($pay['summ'], 2, '.', '');
		$m_desc = base64_encode($pay['details']['comment']);
		$currency = 'RUB';
		$m_key = $params['m_key1'];

        $data = array(
            'shop_id'=> $m_shop,
            'amount'=>$m_amount,
            'currency'=>$currency,
            'order_id'=>$m_orderid,
        );
        if ($params['test_mode'])
        {
            $data['test'] = $params['test_mode'];
        }
        ksort($data);
        $str = http_build_query($data);
        $sign = md5($str . $m_key);

        $result = array(
            'text' => $pay['text'],
            'url' => $params['m_url'],
            'shop_id' => $m_shop,
            'amount' => $m_amount,
            'order_id' => $m_orderid,
            'currency'=> $currency,
            'sign' => $sign,

		);
        if ($params['test_mode'])
        {
            $result['test'] = $params['test_mode'];
        };

		return $result;
	}
}