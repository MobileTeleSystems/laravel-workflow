<?php

namespace Workflow;


use Illuminate\Support\Facades\Bus;
use Workflow\Contracts\Command;

/**
 * Class BusWorkflow
 * @package Workflow
 */
class BusWorkflow extends Workflow
{
    /**
     * @param Command $command
     * @return mixed
     */
    protected function run(Command $command)
    {
        return Bus::dispatch($command);
    }
}
