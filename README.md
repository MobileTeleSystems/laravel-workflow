# Simple workflow for Laravel
Supports 5.6 , 5.7

## Installation

    composer require php-utils/laravel-workflow

Add following to config/app.php
```
  'providers' => [
    ...
    Workflow\Providers\WorkflowServiceProvider::class,
  ],
  
  'aliases' => [
    ...
    'Workflow' => Workflow\Facades\Workflow::class,
  ]
```
Run
```
    php artisan vendor:publish
    
    Select: Provider: Workflow\Providers\WorkflowServiceProvider
```
## Usage

1. Create config for your Subject as shown in example
2. Your Subject should implement ```Workflow\Contracts\Subject```
3. Create commands for each transition, it should implement ```Workflow\Contracts\Command``` 
or extend ```Workflow\Commands\Command```.
If you want to defer the processing of a time consuming command, 
you should extend it from ```Workflow\Commands\QueuedCommand```. 
4. If you have no need in separation transitions by roles you can skip implementing ```Workflow\Contracts\Who```
5. If you have no need in passing context to command you can skip imlementing ```Workflow\Contracts\Context```

## Example
You can see example in config/workflow.php after installation.

Full example: https://github.com/vadim-ostapenko/workflow/blob/master/README.md

Config example:
```
 'lesson' => [
        'states' => [
            'started',
            'paused',
            'finished'
        ],
        'transitions' => [
            [
                'name' => 'pause',
                'routes' => [
                    [
                        'from' => 'started',
                        'to' => 'paused',
                        'who' => ['student']
                    ]
                ]
            ],
            [
                'name' => 'finish',
                'routes' => [
                    [
                        'from' => 'started',
                        'to' => 'finished',
                        'who' => ['teacher']
                    ],
                    [
                        'from' => 'paused',
                        'to' => 'finished',
                        'who' => []
                    ]
                ]
            ]
        ]
    ]
```


```
$lesson     = new \WorkflowExample\Subject\Lesson();
$student    = new \WorkflowExample\Who\Student();
$teacher    = new \WorkflowExample\Who\Teacher();
$workflow   = new \Workflow\BusWorkflow($lesson, \Workflow\Facades\Workflow::get('lesson'));

$workflow->can('answer', $teacher);     //false
$workflow->make('pause', $student);     //pause
$workflow->make('finish', $student);    //finish
```
