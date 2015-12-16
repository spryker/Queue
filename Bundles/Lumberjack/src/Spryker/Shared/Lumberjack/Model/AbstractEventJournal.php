<?php

/**
 * (c) Copyright Spryker Systems GmbH 2015
 */

namespace Spryker\Shared\Lumberjack\Model;

use Spryker\Shared\Config;
use Spryker\Shared\Lumberjack\LumberjackConstants;
use Spryker\Shared\Lumberjack\Model\Collector\DataCollectorInterface;
use Spryker\Shared\Lumberjack\Model\Writer\WriterInterface;

abstract class AbstractEventJournal implements EventJournalInterface
{

    /**
     * @var DataCollectorInterface[]
     */
    private $dataCollectors = [];

    /**
     * @var WriterInterface[]
     */
    private $eventWriters = [];

    public function __construct()
    {
        $this->addConfiguredCollectors();
        $this->addConfiguredWriters();
    }

    /**
     * @return void
     */
    protected function addConfiguredCollectors()
    {
        $collectors = Config::get(LumberjackConstants::COLLECTORS);
        $collectorOptions = Config::get(LumberjackConstants::COLLECTOR_OPTIONS);
        foreach ($collectors[APPLICATION] as $collector) {
            $collectorConfig = isset($collectorOptions[$collector]) ? $collectorOptions[$collector] : [];
            $this->addOrReplaceDataCollector(new $collector($collectorConfig));
        }
    }

    /**
     * @return void
     */
    protected function addConfiguredWriters()
    {
        $writers = Config::get(LumberjackConstants::WRITERS);
        $writerOptions = Config::get(LumberjackConstants::WRITER_OPTIONS);
        foreach ($writers[APPLICATION] as $writer) {
            $writerConfig = isset($writerOptions[$writer]) ? $writerOptions[$writer] : [];
            $this->addOrReplaceEventWriter(new $writer($writerConfig));
        }
    }

    /**
     * @param DataCollectorInterface $dataCollector
     *
     * @return void
     */
    public function addOrReplaceDataCollector(DataCollectorInterface $dataCollector)
    {
        $this->dataCollectors[$dataCollector->getType()] = $dataCollector;
    }

    /**
     * @param EventInterface $event
     *
     * @return void
     */
    public function applyCollectors(EventInterface $event)
    {
        foreach ($this->dataCollectors as $collector) {
            $event->addFields($collector->getData());
        }
    }

    /**
     * @param EventInterface $event
     *
     * @return void
     */
    public function saveEvent(EventInterface $event)
    {
        $this->applyCollectors($event);
        $this->writeEvent($event);
    }

    /**
     * @param WriterInterface $writer
     *
     * @return void
     */
    public function addOrReplaceEventWriter(WriterInterface $writer)
    {
        $this->eventWriters[$writer->getType()] = $writer;
    }

    /**
     * @param EventInterface $event
     *
     * @return void
     */
    protected function writeEvent(EventInterface $event)
    {
        foreach ($this->eventWriters as $writer) {
            $writer->write($event);
        }
    }

}