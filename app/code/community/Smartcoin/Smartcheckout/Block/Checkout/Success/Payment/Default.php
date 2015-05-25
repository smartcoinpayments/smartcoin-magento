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
class Smartcoin_Smartcheckout_Block_Checkout_Success_Payment_Default extends Mage_Core_Block_Template {
  public function setPayment(Varien_Object $payment) {
    $this->setData('payment', $payment);
    return $this;
  }

  public function getPayment() {
    return $this->_getData('payment');
  }

  public function getOrder() {
    return $this->getPayment()->getOrder();
  }
}
