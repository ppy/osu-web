<?php

use App\Models\Forum;
use App\Models\User;
use App\Models\UserGroup;

class ForumTopicsControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        // initial user for forum posts and stuff
        // FIXME: this is actually a hidden dependency
        factory(User::class)->create();
    }

    public function testReply()
    {
        $forum = factory(Forum\Forum::class, 'parent')->create([
            'forum_type' => 1,
        ]);
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $user = factory(User::class)->create()->fresh();
        $userGroup = $this->defaultUserGroup($user);
        $authOption = Forum\AuthOption::firstOrCreate([
            'auth_option' => 'f_reply',
        ]);
        Forum\Authorize::create([
            'group_id' => $userGroup->group_id,
            'forum_id' => $forum->forum_id,
            'auth_option_id' => $authOption->auth_option_id,
            'auth_setting' => 1,
        ]);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        // fail because no plays =)
        $this
            ->actingAs($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());

        // add some plays so it passes
        $this->addPlaycount($user);
        // reset auth
        app()->make('OsuAuthorize')->cacheReset();

        $this
            ->actingAs($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(200);

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());
    }

    public function testShow()
    {
        $forum = factory(Forum\Forum::class, 'parent')->create();
        $topic = factory(Forum\Topic::class)->create([
            'forum_id' => $forum->forum_id,
        ]);
        $post = factory(Forum\Post::class)->create([
            'forum_id' => $forum->forum_id,
            'topic_id' => $topic->topic_id,
        ]);

        $this
            ->get(route('forum.topics.show', $topic->topic_id))
            ->assertStatus(200);
    }

    public function testStore()
    {
        $forum = factory(Forum\Forum::class, 'parent')->create([
            'forum_type' => 1,
        ]);
        $user = factory(User::class)->create()->fresh();
        $userGroup = $this->defaultUserGroup($user);
        $authOption = Forum\AuthOption::firstOrCreate([
            'auth_option' => 'f_post',
        ]);
        Forum\Authorize::create([
            'group_id' => $userGroup->group_id,
            'forum_id' => $forum->forum_id,
            'auth_option_id' => $authOption->auth_option_id,
            'auth_setting' => 1,
        ]);

        $initialPostCount = Forum\Post::count();
        $initialTopicCount = Forum\Topic::count();

        // fail because no plays =)
        $this
            ->actingAs($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum->forum_id]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertStatus(403);

        $this->assertSame($initialPostCount, Forum\Post::count());
        $this->assertSame($initialTopicCount, Forum\Topic::count());

        // add some plays so it passes
        $this->addPlaycount($user);
        // reset auth
        app()->make('OsuAuthorize')->cacheReset();

        $this
            ->actingAs($user)
            ->post(route('forum.topics.store', ['forum_id' => $forum->forum_id]), [
                'title' => 'Test post',
                'body' => 'This is test post',
            ])
            ->assertRedirect(route(
                'forum.topics.show',
                Forum\Topic::orderBy('topic_id', 'DESC')->first()->topic_id
            ));

        $this->assertSame($initialPostCount + 1, Forum\Post::count());
        $this->assertSame($initialTopicCount + 1, Forum\Topic::count());
    }

    private function defaultUserGroup($user)
    {
        $table = (new UserGroup)->getTable();

        $conditions = [
            'user_id' => $user->user_id,
            'group_id' => UserGroup::GROUPS['default'],
        ];

        $existingUserGroup = UserGroup::where($conditions)->first();

        if ($existingUserGroup !== null) {
            return $existingUserGroup;
        }

        DB::table($table)->insert($conditions);

        return UserGroup::where($conditions)->first();
    }

    private function addPlaycount($user, $playcount = null)
    {
        $playcount ?? $playcount = config('osu.forum.minimum_plays');

        $user->monthlyPlaycounts()->create([
            'year_month' => '0111',
            'playcount' => $playcount,
        ]);
    }
}
