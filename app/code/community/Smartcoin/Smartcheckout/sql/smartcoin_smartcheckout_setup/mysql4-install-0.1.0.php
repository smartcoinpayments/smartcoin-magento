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

$installer = $this;
$installer->startSetup();

// Order Payment
$entity = 'order_payment';
$attributes = array(
  'smartcoin_link'        => array('type' => Varien_Db_Ddl_Table::TYPE_VARCHAR),
  'smartcoin_bar_code'    => array('type' => Varien_Db_Ddl_Table::TYPE_VARCHAR),
);

foreach ($attributes as $attribute => $options) {
  $installer->addAttribute($entity, $attribute, $options);
}

$installer->endSetup();
