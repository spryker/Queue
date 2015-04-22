<?php

namespace SprykerFeature\Zed\FrontendExporter\Business\Exporter\Writer\KeyValue;

use SprykerFeature\Shared\Library\Storage\Adapter\KeyValue\ReadWriteInterface;
use SprykerFeature\Shared\Library\Storage\Adapter\KeyValue\RedisReadWrite;
use SprykerFeature\Zed\FrontendExporter\Business\Exporter\Writer\WriterInterface;

class RedisWriter implements WriterInterface
{
    /**
     * @var ReadWriteInterface|RedisReadWrite
     */
    protected $redis;

    /**
     * @param ReadWriteInterface $kvAdapter
     */
    public function __construct(ReadWriteInterface $kvAdapter)
    {
        $this->redis = $kvAdapter;
    }

    /**
     * @param array $dataSet
     * @param string $type
     *
     * @return bool
     */
    public function write(array $dataSet, $type = '')
    {
        return $this->redis->setMulti($dataSet);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'redis-writer';
    }
}
