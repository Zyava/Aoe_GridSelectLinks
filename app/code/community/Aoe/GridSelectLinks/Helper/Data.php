<?php
/**
 * @author Dmytro Zavalkin <dimzav@gmail.com>
 */

class Aoe_GridSelectLinks_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CONFIG_XPATH_SELECT_NOT_GREEN_LINKS_HANDLES = 'adminhtml/aoe_gridSelectLinks/add_select_links/handles';

    /**
     * Get list of handles on which it is allowed to show additional links in grid mass action block
     *
     * @return array|string
     */
    public function getAllowedHandles()
    {
        return Mage::getConfig()->getNode(self::CONFIG_XPATH_SELECT_NOT_GREEN_LINKS_HANDLES)->asCanonicalArray();
    }
}
