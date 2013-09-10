<?php
/**
 * @author Dmytro Zavalkin <dimzav@gmail.com>
 */

class Aoe_GridSelectLinks_Block_Adminhtml_Cache_Notifications extends Mage_Adminhtml_Block_Cache_Notifications
{
    /**
     * List of invalidated cache types
     *
     * @var array
     */
    private $cacheTypes;

    private function _collectCacheTypesWhichRequireRefresh()
    {
        if ($this->cacheTypes === null) {
            $this->cacheTypes = array();
            $invalidatedTypes = Mage::app()->getCacheInstance()->getInvalidatedTypes();
            foreach ($invalidatedTypes as $code => $type) {
                $this->cacheTypes[$code] = $type->getCacheType();
            }
        }
    }

    /**
     * Get array of index names which require data reindex
     *
     * @return array
     */
    public function getCacheTypesForRefresh()
    {
        $this->_collectCacheTypesWhichRequireRefresh();

        return array_values($this->cacheTypes);
    }

    /**
     * Get rebuild indexes url
     *
     * @return string
     */
    public function getRefreshUrl()
    {
        $this->_collectCacheTypesWhichRequireRefresh();
        $query = http_build_query(array('types' => array_keys($this->cacheTypes)));

        return $this->getUrl('adminhtml/cache/massRefresh', array('_query' => $query));
    }

    /**
     * Set custom template
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->setTemplate('aoe_gridSelectLinks/cache_notifications.phtml');
        return parent::_toHtml();
    }
}
