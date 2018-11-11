<?php

/**
 * Example:
 * 'workflow_name' => [
 *      'states' => [
 *          'started',
 *          'paused',
 *          'finished'
 *      ],
 *      'transitions' => [
 *          [
 *              'name'   => 'pause',
 *              'routes' => [
 *                  [
 *                      'from' => 'started',
 *                      'to'   => 'paused',
 *                      'who'   => ['student']
 *                  ]
 *              ]
 *          ],
 *          [
 *              'name'   => 'finish',
 *              'routes' => [
 *                   [
 *                      'from' => 'started',
 *                      'to'   => 'finished',
 *                      'who'   => ['teacher']
 *                  ],
 *                  [
 *                      'from' => 'paused',
 *                      'to'   => 'finished',
 *                      'who'   => []
 *                  ]
 *              ]
 *          ]
 *      ]
 * ]
 */
return [];
