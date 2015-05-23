<?php
/**
 * Smartcoin payment helper
 *
 * @category	Smartcoin
 * @package		Smartcoin_Smartcheckout
 * @author		Arthur Granado <agranado@smartcoin.com.br>
 * @copyright	Smartcoin (https://smartcoin.com.br)
 * @license		http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Smartcoin_Smartcheckout_Helper_Data extends Mage_Core_Helper_Abstract {

	public function getMode() {
    $mode = Mage::getStoreConfig('payment/smartcoin_smartcheckout/mode');
    return $mode;
  }

	public function getApiKey() {
    $apiKey = Mage::getStoreConfig('payment/smartcoin_smartcheckout/api_key_' . $this->getMode());
    return $apiKey;
  }

  public function getApiSecret() {
    $apiSecret = Mage::getStoreConfig('payment/smartcoin_smartcheckout/api_secret_' . $this->getMode());
    return $apiSecret;
  }

  public function getBSInstructions() {
    $apiSecret = Mage::getStoreConfig('payment/smartcoin_smartcheckout_bs/instructions');
    return $apiSecret; 
  }
}