<?php

namespace Workflow\Commands;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class QueuedCommand extends Command implements ShouldQueue
{
    use Queueable;
}
