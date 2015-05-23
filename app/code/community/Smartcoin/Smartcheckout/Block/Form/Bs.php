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
class Smartcoin_Smartcheckout_Block_Form_Bs extends Mage_Payment_Block_Form {

	protected $_instructions;

  protected function _construct() {
    parent::_construct();
    $this->setTemplate('smartcoin/form/bs.phtml');
  }

  public function getInstructions() {
    if (is_null($this->_instructions)) {
      $this->_instructions = Mage::helper('smartcoin_smartcheckout')->getBSInstructions();
    }
    return $this->_instructions;
  }
}