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

class Smartcoin_Smartcheckout_Model_Bs extends Mage_Payment_Model_Method_Abstract {
  protected $_code	=	'smartcoin_smartcheckout_bs';

  protected $_formBlockType = 'smartcoin_smartcheckout/form_bs';
  protected $_infoBlockType = 'smartcoin_smartcheckout/info_bs';
  protected $_isGateway                   = true;
  protected $_canUseForMultishipping      = false;
  protected $_isInitializeNeeded          = true;

  protected $_minOrderTotal = 5.0;
    
  public function __construct() {
		\Smartcoin\Smartcoin::api_key(Mage::helper('smartcoin_smartcheckout')->getApiKey());
		\Smartcoin\Smartcoin::api_secret(Mage::helper('smartcoin_smartcheckout')->getApiSecret());
		Mage::log('API key: ' . Mage::helper('smartcoin_smartcheckout')->getApiKey());
		Mage::log('API secret: ' . Mage::helper('smartcoin_smartcheckout')->getApiSecret());
  }

  public function assignData($data) {
    return $this->getInfoInstance();
  }

  public function initialize($paymentAction, $stateObject) {
    $payment = $this->getInfoInstance();
    $order = $payment->getOrder();
    $amount = $order->getBaseTotalDue();
    $customer = Mage::getSingleton('customer/session');

  	try {
        if($customer->isLoggedIn()) {
            $guestEmail = $order->getCustomerEmail();
        } else {
            $guestEmail = $order->getShippingAddress()->getEmail();
        }
  		$charge = \Smartcoin\Charge::create(array(
		    'amount' => $amount*100,
		    'currency' => 'brl',
		    'type' => 'bank_slip',
		    'receipt_email' => $guestEmail,
		    'description'	=>	sprintf('#%s, %s', $order->getIncrementId(), $guestEmail)
		  ));
		  Mage::log('Charge: ' . $charge->to_json());
		} catch (Exception $e) {
			$this->debugData($e->getMessage());
			Mage::log('Execption: ' . $e->getMessage());
			Mage::throwException(Mage::helper('paygate')->__('Payment capturing error.'));
		}
	
		$payment->setTransactionId($charge->id)
						->setSmartcoinBankSlipLink($charge->bank_slip->link)
						->setSmartcoinBankSlipBarCode($charge->bank_slip->bar_code);
    Mage::log('Charge - Bank Slip link: ' . $payment->getSmartcoinBankSlipLink());
	Mage::log('Charge - Bank Slip bar_code: ' . $payment->getSmartcoinBankSlipBarCode());
    return $this;
  }

  // public function isAvailable($quote = null) {
  // 	if($quote && $quote->getBaseGrandTotal() < $this->_minOrderTotal) {
  // 		return false;
  // 	}	
  //   return $this->getConfigData('api_key', ($quote ? $quote->getStoreId() : null)) && parent::isAvailable($quote);
  // }

}