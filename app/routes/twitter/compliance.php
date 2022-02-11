<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;


$group->group('/compliance', function (Group $compliance) {

  $compliance->get('jobs', GetComplianceJobsAction::class);

  $compliance->post('jobs', CreateComplianceJobAction::class);

  $compliance->get('jobs/{job_id}', GetComplianceJobAction::class);

});