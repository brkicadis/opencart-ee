<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard AG and are explicitly not part
 * of the Wirecard AG range of products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard AG does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard AG does not guarantee their full
 * functionality neither does Wirecard AG assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard AG does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

// Breadcrumb
$_['text_extension'] = 'Extensions';

// Configuration
$_['text_enabled'] = 'Enabled';
$_['text_disabled'] = 'Disabled';
$_['text_credentials'] = 'Credentials';
$_['text_advanced'] = 'Advanced Options';
$_['test_credentials'] = 'Test Credentials';
$_['config_status'] = 'Status';
$_['config_title'] = 'Title';
$_['config_title_desc'] = 'Payment method name as displayed for the consumer during checkout.';
$_['config_merchant_account_id'] = 'Merchant Account ID';
$_['config_merchant_account_id_desc'] = 'Unique identifier assigned to your merchant account.';
$_['config_merchant_secret'] = 'Secret Key';
$_['config_merchant_secret_desc'] = 'Secret Key is mandatory to calculate the Digital Signature for payments.';
$_['config_base_url'] = 'Base URL';
$_['config_base_url_desc'] = 'The Wirecard base URL. (e.g. https://api.wirecard.com)';
$_['config_http_user'] = 'HTTP User';
$_['config_http_user_desc'] = 'HTTP User as provided in your Wirecard contract.';
$_['config_http_password'] = 'HTTP Password';
$_['config_http_password_desc'] = 'HTTP Password as provided in your Wirecard contract.';
$_['config_shopping_basket'] = 'Shopping Basket';
$_['config_shopping_basket_desc'] = 'For the purpose of confirmation, payment supports shopping basket display during checkout. To enable this feature, activate Shopping Basket.';
$_['config_descriptor'] = 'Descriptor';
$_['config_descriptor_desc'] = 'Send text which is displayed on the bank statement issued to your consumer by the financial service provider.';
$_['config_additional_info'] = 'Send additional information';
$_['config_additional_info_desc'] = 'Additional data will be sent for the purpose of fraud protection. This additional data includes billing/shipping address, shopping basket and descriptor.';
$_['config_payment_action'] = 'Payment Action';
$_['text_payment_action_pay'] = 'Purchase';
$_['text_payment_action_reserve'] = 'Authorization';
$_['config_payment_action_desc'] = 'Select between "Purchase" to capture/invoice your order automatically or "Authorization" to capture/invoice manually.';

$_['text_success'] = 'Your modifications are saved!';
$_['success_credentials'] = 'Merchant configuration was successfully tested.';
$_['error_credentials'] = 'Test failed, please check your credentials.';