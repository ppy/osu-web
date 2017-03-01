<?php

use App\Models\Forum;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ForumTopicsControllerTest extends TestCase
{
    use DatabaseTransactions;

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

        $this
            ->actingAs($user)
            ->post(route('forum.topics.reply', $topic->topic_id), [
                'body' => 'This is test reply',
            ])
            ->assertStatus(200);

        $newPostCount = Forum\Post::count();
        $newTopicCount = Forum\Topic::count();

        $this->assertSame(1, $newPostCount - $initialPostCount);
        $this->assertSame(0, $newTopicCount - $initialTopicCount);
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

        $newPostCount = Forum\Post::count();
        $newTopicCount = Forum\Topic::count();

        $this->assertSame(1, $newPostCount - $initialPostCount);
        $this->assertSame(1, $newTopicCount - $initialTopicCount);
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
}
