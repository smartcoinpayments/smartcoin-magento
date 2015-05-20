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

class Smartcoin_Smartcheckout_Model_Observer {
  public function addSmartcoinJavascriptBlock(Varien_Event_Observer $observer) {
      /** @var $block Mage_Core_Block_Abstract */
    $block = $observer->getEvent()->getBlock();
    $blockType = $block->getType();
    $targetBlocks = array(
        'checkout/onepage_payment',
        'aw_onestepcheckout/onestep_form_paymentmethod',
    );
    
    if (in_array($blockType, $targetBlocks)) {
      /** @var $transport Varien_Object */
      $transport = $observer->getEvent()->getTransport();
      $html = $transport->getHtml();
      $preHtml = $block->getLayout()
      ->createBlock('core/template')
      ->setTemplate('smartcoin/checkout/js.phtml')
      ->toHtml();
      $transport->setHtml($preHtml . $html);
    }
  }

  public function addCheckoutJavascriptBlock(Varien_Event_Observer $observer) {
      /** @var $block Mage_Core_Block_Abstract */
    $block = $observer->getEvent()->getBlock();
    $blockType = $block->getType();
    $targetBlocks = array(
        'checkout/onepage_payment',
        'aw_onestepcheckout/onestep_form_paymentmethod',
    );
    
    if (in_array($blockType, $targetBlocks)) {
      /** @var $transport Varien_Object */
      $transport = $observer->getEvent()->getTransport();
      $html = $transport->getHtml();
      $preHtml = $block->getLayout()
      ->createBlock('core/template')
      ->setTemplate('smartcoin/checkout/checkout_js.phtml')
      ->toHtml();
      $transport->setHtml($preHtml . $html);
    }
  }
}
