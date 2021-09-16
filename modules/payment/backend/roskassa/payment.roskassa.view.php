<?php


if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/includes/404.php';
}
echo $result['text'];
?>
<p><img src="https://roskassa.net/wp-content/uploads/2020/12/logo-text-blue.svg " style="width: 400px"></p>
<form method="POST" action="<?php echo $result['url']; ?>">
	<input type="hidden" name="shop_id" value="<?php echo $result['shop_id']; ?>">
	<input type="hidden" name="amount" value="<?php echo $result['amount']; ?>">
    <input type="hidden" name="currency" value="<?=$result['currency']?>">
	<input type="hidden" name="order_id" value="<?php echo $result['order_id']; ?>">
	<input type="hidden" name="sign" value="<?php echo $result['sign']; ?>">
    <?php if ($result['test']){ ?>
    <input type='hidden' name='test' value=<?php echo $result['test']; ?>>
    <?php  } ?>
	<p><input type="submit" value="<?php echo $this->diafan->_('Оплатить', false); ?>" ></p>
</form>


