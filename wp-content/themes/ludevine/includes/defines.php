<?php//define error codesdefine('ERR_PAYMENT', 10000);define('ERR_PAYMENT_CREATE_ORDER', ERR_PAYMENT + 1);define('ERR_PAYMENT_PAYPAL_CREATE_ORDER', ERR_PAYMENT + 2);define('ERR_PAYMENT_PAYPAL_TOKEN', ERR_PAYMENT + 3);define('ERR_PAYMENT_CONFIRM', 20000);define('ERR_PAYMENT_CONFIRM_ORDER_NULL', ERR_PAYMENT_CONFIRM + 1);define('ERR_PAYMENT_REFUND', 30000);define('ERR_VALIDATE', 40000);define('ERR_VALIDATE_ADDRESS', ERR_VALIDATE + 1);define('ERR_VALIDATE_EMAIL', ERR_VALIDATE + 2);