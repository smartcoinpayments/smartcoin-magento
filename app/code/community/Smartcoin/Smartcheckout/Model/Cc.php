<?php
/**
 * Smartcoin payment method model
 *
 * @category	Smartcoin
 * @package		Smartcoin_Smartcheckout
 * @author		Arthur Granado <agranado@smartcoin.com.br>
 * @copyright	Smartcoin (https://smartcoin.com.br)
 * @license		http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once Mage::getBaseDir('lib').DS.'Smartcoin'.DS.'Smartcoin.php';

class Smartcoin_Smartcheckout_Model_Cc extends Mage_Payment_Model_Method_Abstract {
	protected $_code	=	'smartcoin_smartcheckout';

	protected $_formBlockType = 'smartcoin_smartcheckout/form_cc';
	
	protected $_isGateway                   = true;
	protected $_canCapture                  = true;
	protected $_canCapturePartial           = true;
	protected $_canRefund                   = true;
	protected $_canUseForMultishipping      = false;
  protected $_canUseInternal              = false;

  protected $_supportedCurrencyCodes = array('USD');
  protected $_minOrderTotal = 0.5;
    
  public function __construct() {
		\Smartcoin\Smartcoin::api_key(Mage::helper('smartcoin_smartcheckout')->getApiKey());
		\Smartcoin\Smartcoin::api_secret(Mage::helper('smartcoin_smartcheckout')->getApiSecret());
		Mage::log('API key: ' . Mage::helper('smartcoin_smartcheckout')->getApiKey());
		Mage::log('API secret: ' . Mage::helper('smartcoin_smartcheckout')->getApiSecret());
  }    
      
	public function assignData($data) {
    if (!($data instanceof Varien_Object)) {
         $data = new Varien_Object($data);
     }
     Mage::log('Assign Customer: ' . $data->getSmartcoinCustomer());
     Mage::log('Assign Installment: ' . $data->getSmartcoinInstallment());
     Mage::log('Assign Payment Method: ' . $data->getSmartcoinPaymentMethod());
     $info = $this->getInfoInstance();
     $info->setSmartcoinCustomer($data->getSmartcoinCustomer());
     $info->setSmartcoinInstallment($data->getSmartcoinInstallment());
     $info->setSmartcoinPaymentMethod($data->getSmartcoinPaymentMethod());
     return $this;
  }

  public function capture(Varien_Object $payment, $amount) {
  	$order = $payment->getOrder();
  	$billing = $order->getBillingAddress();

  	Mage::log('Shipment Address: ' . $order->getShippingAddress());
  	try {
  		$charge = \Smartcoin\Charge::create(array(
		    'amount' => $amount*100,
		    'currency' => 'brl',
		    'customer' => $payment->getSmartcoinCustomer(),
		    'installment' => $payment->getSmartcoinInstallment(),
		    'receipt_email' => $order->getCustomerEmail(),
		    'description'	=>	sprintf('#%s, %s', $order->getIncrementId(), $order->getCustomerEmail())
		  ));
		  Mage::log('Charge: ' . $charge->to_json());
		} catch (Exception $e) {
			$this->debugData($e->getMessage());
			Mage::log('Execption: ' . $e->getMessage());
			Mage::throwException(Mage::helper('paygate')->__('Payment capturing error.'));
		}
	
    $payment->setTransactionId($charge->id)->setIsTransactionClosed(0);
    return $this;
  }
  
  public function refund(Varien_Object $payment, $amount) {
  	$transactionId = $payment->getParentTransactionId();

		try {
			\Smartcoin\Charge::retrieve($transactionId)->refund();
		} catch (Exception $e) {
			$this->debugData($e->getMessage());
			Mage::throwException(Mage::helper('paygate')->__('Payment refunding error.'));
		}

		$payment
			->setTransactionId($transactionId . '-' . Mage_Sales_Model_Order_Payment_Transaction::TYPE_REFUND)
			->setParentTransactionId($transactionId)
			->setIsTransactionClosed(1)
			->setShouldCloseParentTransaction(1);	
	
    return $this;
  }    
    
	public function isAvailable($quote = null) {
  	if($quote && $quote->getBaseGrandTotal()<$this->_minOrderTotal) {
  		return false;
  	}
  	
    return $this->getConfigData('api_key', ($quote ? $quote->getStoreId() : null)) && parent::isAvailable($quote);
  }
    
  public function canUseForCurrency($currencyCode) {
    if (!in_array($currencyCode, $this->_supportedCurrencyCodes)) {
        return false;
    }
    return true;
  }
	
}