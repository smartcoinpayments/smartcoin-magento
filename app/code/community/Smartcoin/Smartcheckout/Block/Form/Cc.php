<?php
/**
 * Smartcoin payment method model
 *
 * @category  Smartcoin
 * @package   Smartcoin_Smartcheckout
 * @author    Arthur Granado <agranado@smartcoin.com.br>
 * @copyright Smartcoin (https://smartcoin.com.br)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Smartcoin_Smartcheckout_Block_Form_Cc extends Mage_Payment_Block_Form_Cc {

  protected $_creditCards;

  protected function _construct() {
    parent::_construct();
    $this->setTemplate('smartcoin/form/cc.phtml');
  }

  public function getCcInstallments() {
  	for ($i=1; $i <= 12; $i++) {
      $installment[$i] = $i;
    }
    $this->setData('cc_installment', $installment);
    return $installment;
  }

  public function getCcMonths() {
    $months = $this->getData('cc_months');
    if (is_null($months)) {
      $months[0] =  $this->__('Month');
      for ($i=1; $i <= 12; $i++) {
        $months[$i] = str_pad($i, 2, '0', STR_PAD_LEFT);
      }
      $this->setData('cc_months', $months);
    }
    return $months;
  }
}
