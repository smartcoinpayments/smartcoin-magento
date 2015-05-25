<?php
/**
 * Smartcoin payment method model
 *
 * @category    Smartcoin
 * @package     Smartcoin_Smartcheckout
 * @author      Arthur Granado <agranado@smartcoin.com.br>
 * @copyright   Smartcoin (https://smartcoin.com.br)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Smartcoin_Smartcheckout_Block_Checkout_Success_Payment_Bs extends Smartcoin_Smartcheckout_Block_Checkout_Success_Payment_Default {
	public function getSmartcoinBankSlipLink() {
		Mage::log('Bank Slip Link 2: ' . $this->getPayment()->getSmartcoinBankSlipLink());
    return $this->getPayment()->getSmartcoinBankSlipLink();
  }

  public function getSmartcoinBankSlipBarCode() {
  	Mage::log('Bank Slip Bar Code 2: ' . $this->getPayment()->getSmartcoinBankSlipBarCode());
    return $this->getPayment()->getSmartcoinBankSlipBarCode();
  }
}
