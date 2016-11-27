<?php
/* Template Name: [ Pagueseguro Atualiza ] */
require "includes/config.php";
require "includes/dPagSeguro-master/dPagSeguro.inc.php";

$ps = new dPagSeguro($pgemail, $token);

$notificInfo = $ps->getNotification($_POST['notificationType'], $_POST['notificationCode']);

$acc=array(':transaction_id'=> $notificInfo['code']);



$account_query = $con->prepare("SELECT `transaction_id`, `account_id`, `Rops` FROM `doacao` WHERE transaction_id = :transaction_id");
$account_query->execute($acc);
$account_info = $account_query->fetch(PDO::FETCH_OBJ);


if (!empty($account_info)){

	$acc=array(':transaction_id'=> $notificInfo['code'], ':status'=> $notificInfo['status']);

	$update=array(':Rops'=>$account_info->Rops, ':account_id'=>$account_info->account_id);

	$add_compra_query = $con->prepare("UPDATE `doacao`SET `estado` = :status WHERE transaction_id = :transaction_id");
	$add_compra_query->execute($acc);

	$cash_update = $con->prepare("UPDATE `global_reg_value` SET value = value + :Rops WHERE `account_id` = :account_id AND str = '#CASHPOINTS'");
	$cash_update->execute($update);
}

?>