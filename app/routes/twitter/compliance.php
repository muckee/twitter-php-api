<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Compliance\BatchCompliance\GetComplianceJobsAction;
use App\Application\Actions\Twitter\Compliance\BatchCompliance\GetComplianceJobAction;
use App\Application\Actions\Twitter\Compliance\BatchCompliance\CreateComplianceJobAction;


$group->group('/compliance', function (Group $compliance) {

  $compliance->get('jobs', GetComplianceJobsAction::class);

  $compliance->post('jobs', CreateComplianceJobAction::class);

  $compliance->get('jobs/{job_id}', GetComplianceJobAction::class);

});