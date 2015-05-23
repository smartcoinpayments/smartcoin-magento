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
class Smartcoin_Smartcheckout_Block_Info_Bs extends Mage_Payment_Block_Info {
  protected function _construct() {
    parent::_construct();
    $this->setTemplate('smartcoin/info/bs.phtml');
  } 

  public function getSmartcoinBankSlipLink() {
    return $this->getInfo()->getSmartcoinBankSlipLink();
  }

  public function getSmartcoinBankSlipBarCode() {
    return $this->getInfo()->getSmartcoinBankSlipBarCode();
  }
}
