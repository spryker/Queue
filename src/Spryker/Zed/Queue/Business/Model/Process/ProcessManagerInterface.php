<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Queue\Business\Model\Process;

interface ProcessManagerInterface
{

    /**
     * @param string $queue
     * @param string $command
     *
     * @return \Symfony\Component\Process\Process
     */
    public function triggerQueueProcess($command, $queue);

    /**
     * @param array $queueName
     *
     * @return int
     */
    public function getBusyProcessNumber($queueName);

    /**
     * @return void
     */
    public function flushIdleProcesses();

}