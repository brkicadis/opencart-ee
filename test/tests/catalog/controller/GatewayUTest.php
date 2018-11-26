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

use Mockery as m;

require_once __DIR__ . '/../../../../catalog/controller/extension/payment/wirecard_pg_paypal.php';
require_once __DIR__ . '/../../../../catalog/model/extension/payment/wirecard_pg_paypal.php';

require_once __DIR__ . '/../../../../catalog/controller/extension/payment/wirecard_pg_pia.php';
require_once __DIR__ . '/../../../../catalog/model/extension/payment/wirecard_pg_pia.php';

use Wirecard\PaymentSdk\Transaction\PoiPiaTransaction;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class GatewayUTest extends \PHPUnit_Framework_TestCase
{
	protected $config;
	private $pluginVersion = '1.3.0';
	private $controller;
	private $loader;
	private $registry;
	private $session;
	private $response;
	private $modelOrder;
	private $url;
	private $language;
	private $cart;
	private $currency;

	const SHOP = 'OpenCart';
	const PLUGIN = 'Wirecard OpenCart Extension';

	public function setUp()
	{
		$this->registry = $this->getMockBuilder(Registry::class)->disableOriginalConstructor()->getMock();

		$this->config = $this->getMockBuilder(Config::class)
			->disableOriginalConstructor()
			->setMethods(['get'])
			->getMock();

		$this->config->method('get')->willReturn('somthing');

		$this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();

		$this->response = $this->getMockBuilder(Response::class)
			->disableOriginalConstructor()
			->setMethods(['addHeader', 'setOutput', 'getOutput', 'redirect'])
			->getMock();

		$this->modelOrder = $this->getMockBuilder(ModelCheckoutOrder::class)
			->disableOriginalConstructor()
			->setMethods(['getOrder', 'addOrderHistory'])
			->getMock();

		$this->cart = $this->getMockBuilder(Cart::class)
			->disableOriginalConstructor()
			->setMethods(['getProducts'])
			->getMock();

        $orderDetails = array(
            'order_id' => '1',
            'total' => '20',
            'currency_code' => 'EUR',
            'language_code' => 'en-GB',
            'email' => 'test@test.com',
            'firstname' => 'Jon',
            'lastname' => 'Doe',
            'ip' => '1',
            'store_name' => 'Demoshop',
            'currency_value' => 1.12,
            'customer_id' => 1,
            'payment_iso_code_2' => 'AT',
            'payment_zone_code' => 'OR',
            'payment_city' => 'BillingCity',
            'payment_address_1' => 'BillingStreet1',
            'payment_address_2' => 'BillingStreet2',
            'payment_postcode' => '0000',
            'payment_firstname' => 'Jon',
            'payment_lastname' => 'Doe',
            'telephone' => '000356788990',
            'shipping_iso_code_2' => 'AT',
            'shipping_zone_code' => 'OR',
            'shipping_city' => 'ShippingCity',
            'shipping_address_1' => 'ShippingStreet',
            'shipping_postcode' => '0000',
            'shipping_firstname' => 'Tina',
            'shipping_lastname' => 'Doe',
        );

		$this->modelOrder->method('getOrder')->willReturn($orderDetails);

		$this->url = $this->getMockBuilder(Url::class)->disableOriginalConstructor()->getMock();

		$this->loader = $this->getMockBuilder(Loader::class)
			->disableOriginalConstructor()
			->setMethods(['model', 'language', 'view'])
			->getMock();

		$this->language = $this->getMockBuilder(Language::class)->disableOriginalConstructor()->getMock();

		$this->currency = $this->getMockBuilder(Currency::class)->disableOriginalConstructor()->getMock();

		$items = [
			["price" => 10.465, "name" => "Produkt1", "quantity" => 2, "product_id" => 2, "tax_class_id" => 2],
			["price" => 20.241, "name" => "Produkt2", "quantity" => 3, "product_id" => 1, "tax_class_id" => 1],
			["price" => 3.241, "name" => "Produkt3", "quantity" => 5, "product_id" => 3, "tax_class_id" => 1]
		];

		$this->cart->method('getProducts')->willReturn($items);
	}

	public function testSuccessResponse()
	{
		$modelPaypal = $this->getMockBuilder(ModelExtensionPaymentWirecardPGPayPal::class)
			->disableOriginalConstructor()
			->setMethods(['sendRequest'])
			->getMock();

		$this->controller = new ControllerExtensionPaymentWirecardPGPayPal(
			$this->registry,
			$this->config,
			$this->loader,
			$this->session,
			$this->response,
			$this->modelOrder,
			$this->url,
			$modelPaypal,
			$this->language,
			$this->cart,
			$this->currency
		);

		$orderManager = m::mock('overload:PGOrderManager');
		$orderManager->shouldReceive('createResponseOrder');

		$_REQUEST = array(
			"route" => "extension/payment/wirecard_pg_paypal/response",
			"psp_name" => "elastic-payments",
			"custom_css_url" => "",
			"eppresponse" => ResponseProvider::getPaypalSuccessResponse(),
			"locale" => "en",
		);

		$response = $this->controller->response();

		$this->assertTrue($response);
	}

	public function testFailureResponse()
	{
		$modelPaypal = $this->getMockBuilder(ModelExtensionPaymentWirecardPGPayPal::class)
			->disableOriginalConstructor()
			->setMethods(['sendRequest'])
			->getMock();

		$this->controller = new ControllerExtensionPaymentWirecardPGPayPal(
			$this->registry,
			$this->config,
			$this->loader,
			$this->session,
			$this->response,
			$this->modelOrder,
			$this->url,
			$modelPaypal,
			$this->language,
			$this->cart,
			$this->currency
		);

		$orderManager = m::mock('overload:PGOrderManager');
		$orderManager->shouldReceive('updateCancelFailureOrder');

		$_REQUEST = array(
			"route" => "extension/payment/wirecard_pg_paypal/response",
			"psp_name" => "elastic-payments",
			"custom_css_url" => "",
			"eppresponse" => ResponseProvider::getPaypalFailureResponse(),
			"locale" => "en",
		);

		$response = $this->controller->response();

		$this->assertFalse($response);
	}

	public function testMalformedResponse()
	{
		$modelPaypal = $this->getMockBuilder(ModelExtensionPaymentWirecardPGPayPal::class)
			->disableOriginalConstructor()
			->setMethods(['sendRequest'])
			->getMock();

		$this->controller = new ControllerExtensionPaymentWirecardPGPayPal(
			$this->registry,
			$this->config,
			$this->loader,
			$this->session,
			$this->response,
			$this->modelOrder,
			$this->url,
			$modelPaypal,
			$this->language,
			$this->cart,
			$this->currency
		);

		$_REQUEST = array(
			"payment-method" => "paypal"
		);

		$this->controller->response();

		$this->assertArrayHasKey('error', $this->session->data);
		$this->assertEquals('Missing response in payload.', $this->session->data['error']);
	}
}