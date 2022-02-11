<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Lists\ListsLookup\GetListByIdAction;

use App\Application\Actions\Twitter\Lists\ManageLists\CreateList;
use App\Application\Actions\Twitter\Lists\ManageLists\DeleteList;
use App\Application\Actions\Twitter\Lists\ManageLists\UpdateList;

use App\Application\Actions\Twitter\Lists\TweetsLookup\GetListTweetsAction;

use App\Application\Actions\Twitter\Lists\ListMembers\ListMembersLookup\GetListMembersAction;
use App\Application\Actions\Twitter\Lists\ListMembers\ManageListMembers\AddMemberToListAction;
use App\Application\Actions\Twitter\Lists\ListMembers\ManageListMembers\RemoveMemberFromListAction;

use App\Application\Actions\Twitter\Lists\ListFollows\ListFollowsLookup\GetListFollowersAction;

$group->post('/lists', CreateList::class);

$group->group('/lists', function (Group $lists) {

  $lists->get('/{list_id}', GetListByIdAction::class);

  $lists->put('/{list_id}', UpdateList::class);

  $lists->delete('/{list_id}', DeleteList::class);

  $lists->group('/{list_id}', function (Group $list) {

    $list->get('/tweets', GetListTweetsAction::class);

    $list->get('/members', GetListMembersAction::class);

    $list->post('/members', AddMemberToListAction::class);

    $list->delete('/members/{user_id}', RemoveMemberFromListAction::class);

    $list->get('/followers', GetListFollowersAction::class);
  });

});