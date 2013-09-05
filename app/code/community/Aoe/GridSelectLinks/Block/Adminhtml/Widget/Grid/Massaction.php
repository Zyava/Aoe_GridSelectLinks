<?php
/**
 * @author Dmytro Zavalkin <dimzav@gmail.com>
 */

class Aoe_GridSelectLinks_Block_Adminhtml_Widget_Grid_Massaction
    extends Mage_Adminhtml_Block_Widget_Grid_Massaction
{
    /**
     * Sets Massaction template
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('aoe_gridSelectLinks/massaction.phtml');
    }

    /**
     * Check whether additional links should be shown
     *
     * @return bool
     */
    public function showAdditionalLinks()
    {
        return in_array($this->getAction()->getFullActionName(),
            Mage::helper('aoe_gridSelectLinks')->getAllowedHandles()
        );
    }
}
