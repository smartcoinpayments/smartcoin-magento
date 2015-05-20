<?php
/**
 * Payment CC Types Source Model
 *
 * @category	Smartcoin
 * @package		Smartcoin_Smartcheckout
 * @author		Arthur Granado <agranado@smartcoin.com.br>
 * @copyright	Smartcoin (https://smartcoin.com.br)
 * @license		http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Smartcoin_Smartcheckout_Model_Source_Cctype extends Mage_Payment_Model_Source_Cctype {
	protected $_allowedTypes = array('AE','VI','MC','DI','JCB','OT');
}
