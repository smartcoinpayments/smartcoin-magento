<?php
/**
 * Smartcoin payment helper
 *
 * @category    Smartcoin
 * @package     Smartcoin_Smartcheckout
 * @author      Arthur Granado <agranado@smartcoin.com.br>
 * @copyright   Smartcoin (https://smartcoin.com.br)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Smartcoin_Smartcheckout_Model_Source_Mode {
  const MODE_TEST = 'test';
  const MODE_LIVE = 'live';

  public function toOptionArray() {
    return array(
      array(
        'value' => self::MODE_TEST,
        'label' => Mage::helper('smartcoin_smartcheckout')->__('Test')
      ),
      array(
        'value' => self::MODE_LIVE,
        'label' => Mage::helper('smartcoin_smartcheckout')->__('Live')
      ),
    );
  }
}
