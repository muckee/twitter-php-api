<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\Timelines\GetUserTimelineAction;
use App\Application\Actions\Twitter\Tweets\Timelines\GetUserMentionsTimelineAction;

use App\Application\Actions\Twitter\Tweets\Retweets\ManageRetweets\CreateRetweetAction;
use App\Application\Actions\Twitter\Tweets\Retweets\ManageRetweets\DeleteRetweetAction;

use App\Application\Actions\Twitter\Tweets\Likes\LikesLookup\GetLikedTweetsAction;
use App\Application\Actions\Twitter\Tweets\Likes\ManageLikes\LikeTweetAction;
use App\Application\Actions\Twitter\Tweets\Likes\ManageLikes\DeleteLikedTweetAction;

use App\Application\Actions\Twitter\Users\UsersLookup\GetUsersByIdAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUserByIdAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUsersByUsernameAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUserByUsernameAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetAuthorizedUserAction;

use App\Application\Actions\Twitter\Users\Follows\FollowsLookup\GetFollowingByUserIdAction;
use App\Application\Actions\Twitter\Users\Follows\FollowsLookup\GetFollowingByUsernameAction;
use App\Application\Actions\Twitter\Users\Follows\FollowsLookup\GetFollowersByUserIdAction;
use App\Application\Actions\Twitter\Users\Follows\FollowsLookup\GetFollowersByUsernameAction;
use App\Application\Actions\Twitter\Users\Follows\ManageFollows\FollowUserAction;
use App\Application\Actions\Twitter\Users\Follows\ManageFollows\UnfollowUserAction;

use App\Application\Actions\Twitter\Users\Blocks\BlocksLookup\GetBlockedUsersAction;
use App\Application\Actions\Twitter\Users\Blocks\ManageBlocks\BlockUserAction;
use App\Application\Actions\Twitter\Users\Blocks\ManageBlocks\UnblockUserAction;

use App\Application\Actions\Twitter\Users\Mutes\MutesLookup\GetMutedUsersAction;
use App\Application\Actions\Twitter\Users\Mutes\ManageMutes\MuteUserAction;
use App\Application\Actions\Twitter\Users\Mutes\ManageMutes\UnmuteUserAction;

use App\Application\Actions\Twitter\Lists\ListsLookup\GetOwnedListsAction;

use App\Application\Actions\Twitter\Lists\ListMembers\ListMembersLookup\GetMemberListsAction;

use App\Application\Actions\Twitter\Lists\ListFollows\ListFollowsLookup\GetFollowedListsAction;
use App\Application\Actions\Twitter\Lists\ListFollows\ManageListFollows\FollowListAction;
use App\Application\Actions\Twitter\Lists\ListFollows\ManageListFollows\UnfollowListAction;

use App\Application\Actions\Twitter\Lists\PinnedLists\PinnedListsLookup\GetPinnedListsAction;
use App\Application\Actions\Twitter\Lists\PinnedLists\ManagePinnedLists\PinListAction;
use App\Application\Actions\Twitter\Lists\PinnedLists\ManagePinnedLists\UnpinListAction;

$group->get('/users', GetUsersByIdAction::class);

$group->group('/users', function (Group $users) {

  $users->get('/me', GetAuthorizedUserAction::class);

  $users->get('/by', GetUsersByUsernameAction::class);

  // Get a list of tweets based on a CSV string of tweet IDs
  $users->group('/by/username', function (Group $byUsername) {

    $byUsername->get('/{username}', GetUserByUsernameAction::class);

    $byUsername->group('/{username}', function(Group $user) {

      $user->get('/following', GetFollowingByUsernameAction::class);

      $user->get('/followers', GetFollowersByUsernameAction::class);
    });
  });

  $users->get('/{user_id}', GetUserByIdAction::class);

  // Get a list of tweets based on a CSV string of tweet IDs
  $users->group('/{user_id}', function (Group $user) {

    /**
     * Returns most recent tweets composed by a specified user ID
     */
    $user->get('/tweets', GetUserTimelineAction::class);

    /**
     * Returns most recent tweets mentioning a specified user ID
     */
    $user->get('/mentions', GetUserMentionsTimelineAction::class);

    /**
     * Allows a user ID to Retweet a Tweet
     */
    $user->post('/retweets', CreateRetweetAction::class);

    /**
     * Allows a user ID to undo a Retweet
     */
    $user->delete('/retweets/{source_tweet_id}', DeleteRetweetAction::class);

    $user->get('/liked_tweets', GetLikedTweetsAction::class);

    $user->post('/likes', LikeTweetAction::class);

    $user->delete('/likes/{tweet_id}', DeleteLikedTweetAction::class);

    $user->get('/following', GetFollowingByUserIdAction::class);

    $user->post('/following', FollowUserAction::class);

    $user->delete('/following/{target_user_id}', UnfollowUserAction::class);

    $user->get('/followers', GetFollowersByUserIdAction::class);

    $user->get('/blocking', GetBlockedUsersAction::class);

    $user->post('/blocking', BlockUserAction::class);

    $user->delete('/blocking/{target_user_id}', UnblockUserAction::class);

    $user->get('/muting', GetMutedUsersAction::class);

    $user->post('/muting', MuteUserAction::class);

    $user->delete('/muting', UnmuteUserAction::class);

    $user->get('/owned_lists', GetOwnedListsAction::class);

    $user->get('/list_memberships', GetMemberListsAction::class);

    $user->get('/followed_lists', GetFollowedListsAction::class);

    $user->post('/followed_lists', FollowListAction::class);

    $user->delete('/followed_lists/{list_id}', UnfollowListAction::class);

    $user->get('/pinned_lists', GetPinnedListsAction::class);

    $user->post('/pinned_lists', PinListAction::class);

    $user->delete('/pinned_lists/{list_id}', UnpinListAction::class);
  });
});