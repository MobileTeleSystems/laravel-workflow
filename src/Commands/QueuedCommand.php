<?php

namespace Workflow\Commands;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Workflow\Actions\Action;
use Workflow\Contracts\Command;

abstract class QueuedCommand extends Action implements Command, ShouldQueue
{
    use Queueable;
}
