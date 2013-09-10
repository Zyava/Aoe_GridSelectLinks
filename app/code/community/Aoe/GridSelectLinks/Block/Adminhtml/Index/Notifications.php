<?php
/**
 * @author Dmytro Zavalkin <dimzav@gmail.com>
 */

class Aoe_GridSelectLinks_Block_Adminhtml_Index_Notifications extends Mage_Index_Block_Adminhtml_Notifications
{
    /**
     * List of indexes which require rebuild
     *
     * @var array
     */
    private $_indexers;

    private function _collectIndexersWhichRequireReindex()
    {
        if ($this->_indexers === null) {
            $this->_indexers = array();
            $processes = Mage::getSingleton('index/indexer')->getProcessesCollection()->addEventsStats();
            /** @var $process Mage_Index_Model_Process */
            foreach ($processes as $process) {
                if (($process->getStatus() == Mage_Index_Model_Process::STATUS_REQUIRE_REINDEX
                    || $process->getEvents() > 0) && $process->getIndexer()->isVisible()
                ) {
                    $this->_indexers[$process->getId()] = $process->getIndexer()->getName();
                }
            }
        }
    }

    /**
     * Get array of index names which require data reindex
     *
     * @return array
     */
    public function getProcessesForReindex()
    {
        $this->_collectIndexersWhichRequireReindex();

        return array_values($this->_indexers);
    }

    /**
     * Get rebuild indexes url
     *
     * @return string
     */
    public function getRebuildUrl()
    {
        $this->_collectIndexersWhichRequireReindex();
        $query = http_build_query(array('process' => array_keys($this->_indexers)));

        return $this->getUrl('adminhtml/process/massReindex', array('_query' => $query));
    }

    /**
     * Set custom template
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->setTemplate('aoe_gridSelectLinks/index_notifications.phtml');
        return parent::_toHtml();
    }
}
