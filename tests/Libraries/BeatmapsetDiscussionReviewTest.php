<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Events\NewPrivateNotificationEvent;
use App\Exceptions\InvariantException;
use App\Jobs\Notifications\BeatmapsetDiscussionQualifiedProblem;
use App\Jobs\Notifications\BeatmapsetDisqualify;
use App\Jobs\Notifications\BeatmapsetResetNominations;
use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use Faker;
use Illuminate\Support\Facades\Event;
use Queue;
use Tests\TestCase;

class BeatmapsetDiscussionReviewTest extends TestCase
{
    protected static $faker;
    protected $beatmap;
    protected $beatmapset;
    protected $user;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Faker\Factory::create();
    }

    //region BeatmapsetDiscussionReview::create()

    //region Failure Scenarios

    // empty document
    public function testCreateDocumentEmpty()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create($this->beatmapset, [], $this->user);
    }

    // missing block type
    public function testCreateDocumentMissingBlockType()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'text' => 'invalid lol',
                ],
            ],
            $this->user
        );
    }

    // invalid block type
    public function testCreateDocumentInvalidBlockType()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'invalid lol',
                ],
            ],
            $this->user
        );
    }

    // invalid paragraph block
    public function testCreateDocumentInvalidParagraphBlockContent()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'paragraph',
                ],
            ],
            $this->user
        );
    }

    // invalid embed block
    public function testCreateDocumentInvalidEmbedBlockContent()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'embed',
                ],
            ],
            $this->user
        );
    }

    // valid document containing zero issue embeds
    public function testCreateDocumentValidParagraphWithNoIssues()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'paragraph',
                    'text' => 'this is a text',
                ],
            ],
            $this->user
        );
    }

    // valid paragraph but text is JSON
    public function testCreateDocumentValidParagraphButJSON()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'paragraph',
                    'text' => ['y', 'tho'],
                ],
            ],
            $this->user
        );
    }

    // valid review but text is JSON
    public function testCreateDocumentValidIssueButJSON()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => ['y', 'tho'],
                    'timestamp' => true,
                    'beatmap_id' => $this->beatmap->getKey(),
                ],
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => self::$faker->sentence(),
                ],
            ],
            $this->user
        );
    }

    // document with too many blocks
    public function testCreateDocumentValidWithTooManyBlocks()
    {
        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => self::$faker->sentence(),
                ],
            ],
            $this->user
        );
    }

    //endregion

    //region Success Scenarios

    // valid document containing issue embeds
    public function testCreateDocumentDocumentValidWithIssues()
    {
        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();
        $timestampedIssueText = '00:01:234 '.self::$faker->sentence();
        $issueText = self::$faker->sentence();

        BeatmapsetDiscussionReview::create(
            $this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $timestampedIssueText,
                    'timestamp' => true,
                    'beatmap_id' => $this->beatmap->getKey(),
                ],
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $issueText,
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $this->user
        );

        $discussionJson = json_encode($this->beatmapset->defaultDiscussionJson());
        $this->assertStringContainsString("\"message\":\"{$timestampedIssueText}\"", $discussionJson);
        $this->assertStringContainsString('"timestamp":1234', $discussionJson);
        $this->assertStringContainsString("\"message\":\"{$issueText}\"", $discussionJson);

        // ensure 3 discussions/posts are created - one for the review and one for each embedded problem
        $this->assertSame($discussionCount + 3, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount + 3, BeatmapDiscussionPost::count());
    }

    // valid document containing issue embeds should trigger disqualification (for GMT)
    public function testCreateDocumentDocumentValidWithIssuesShouldDisqualify()
    {
        $gmtUser = User::factory()->withGroup('gmt')->create();
        $beatmapset = Beatmapset::factory()->qualified()->create();
        $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $watchingUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $watchingUser->getKey()]);

        BeatmapsetDiscussionReview::create(
            $beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $gmtUser
        );

        // ensure qualified beatmap has been reset to pending
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['pending']);

        // ensure a disqualification notification is dispatched
        Queue::assertPushed(BeatmapsetDisqualify::class);
        $this->runFakeQueue();
        Event::assertDispatched(NewPrivateNotificationEvent::class);
    }

    // valid document containing issue embeds should reset nominations (for GMT)
    public function testCreateDocumentDocumentValidWithIssuesShouldResetNominations()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmapset->beatmaps()->save(Beatmap::factory()->make());

        $playmode = $beatmapset->playmodesStr()[0];
        $natUser = User::factory()->withGroup('nat', [$playmode])->create();
        $watchingUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $watchingUser->getKey()]);

        // ensure beatmapset has a nomination
        $beatmapset->nominate($natUser, [$playmode]);
        $this->assertSame($beatmapset->currentNominationCount()[$playmode], 1);

        BeatmapsetDiscussionReview::create(
            $beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $natUser
        );

        $beatmapset->refresh();

        // ensure beatmap is still pending
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['pending']);
        // ensure nomination count has been reset
        $this->assertSame($beatmapset->currentNominationCount()[$playmode], 0);

        // ensure a nomination reset notification is dispatched
        Queue::assertPushed(BeatmapsetResetNominations::class);
        $this->runFakeQueue();
        Event::assertDispatched(NewPrivateNotificationEvent::class);
    }

    // valid document containing issue embeds should reset nominations (for GMT)
    /**
     * @dataProvider dataProviderForQualifiedProblem
     */
    public function testCreateDocumentDocumentValidWithNewIssuesShouldNotify($state, $shouldNotify)
    {
        $gmtUser = User::factory()->withGroup('gmt')->create();
        $beatmapset = Beatmapset::factory()->$state()->create();
        $beatmapset->beatmaps()->save(Beatmap::factory()->make(['playmode' => 0]));

        $notificationOption = $gmtUser->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['osu']]]);

        BeatmapsetDiscussionReview::create(
            $beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $this->user
        );

        // ensure beatmap status hasn't changed.
        $this->assertSame($beatmapset->status(), $state);

        if ($shouldNotify) {
            // ensure a new problem notification is dispatched
            Queue::assertPushed(BeatmapsetDiscussionQualifiedProblem::class);
            $this->runFakeQueue();
            Event::assertDispatched(NewPrivateNotificationEvent::class);
        } else {
            Queue::assertNotPushed(BeatmapsetDiscussionQualifiedProblem::class);
            $this->runFakeQueue();
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    //endregion

    //endregion

    //region BeatmapsetDiscussionReview::update()

    //region Failure Scenarios

    // empty document
    public function testUpdateDocumentEmpty()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([]);
    }

    // missing block type
    public function testUpdateDocumentMissingBlockType()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'text' => 'invalid lol',
            ],
        ]);
    }

    // invalid block type
    public function testUpdateDocumentInvalidBlockType()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'invalid lol',
            ],
        ]);
    }

    // invalid paragraph block
    public function testUpdateDocumentInvalidParagraphBlockContent()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'paragraph',
            ],
        ]);
    }

    // invalid embed block
    public function testUpdateDocumentInvalidEmbedBlockContent()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'embed',
            ],
        ]);
    }

    // valid document containing zero issue embeds
    public function testUpdateDocumentValidParagraphWithNoIssues()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'paragraph',
                'text' => 'this is a text',
            ],
        ]);
    }

    // valid paragraph but text is JSON
    public function testUpdateDocumentValidParagraphButJSON()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'paragraph',
                'text' => ['y', 'tho'],
            ],
        ]);
    }

    // valid review but text is JSON
    public function testUpdateDocumentValidIssueButJSON()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'embed',
                'discussion_type' => 'problem',
                'text' => ['y', 'tho'],
                'timestamp' => true,
                'beatmap_id' => $this->beatmap->getKey(),
            ],
            [
                'type' => 'embed',
                'discussion_type' => 'problem',
                'text' => self::$faker->sentence(),
            ],
        ]);
    }

    // document with too many blocks
    public function testUpdateDocumentValidWithTooManyBlocks()
    {
        $this->expectException(InvariantException::class);
        $this->updateReview([
            [
                'type' => 'embed',
                'discussion_type' => 'problem',
                'text' => self::$faker->sentence(),
            ],
            [
                'type' => 'paragraph',
                'text' => self::$faker->sentence(),
            ],
            [
                'type' => 'paragraph',
                'text' => self::$faker->sentence(),
            ],
            [
                'type' => 'paragraph',
                'text' => self::$faker->sentence(),
            ],
            [
                'type' => 'paragraph',
                'text' => self::$faker->sentence(),
            ],
        ]);
    }

    // document referencing issues belonging to another review
    public function testUpdateDocumentValidWithExternalReference()
    {
        $review = $this->setUpReview();

        $differentReview = $this->setUpReview();
        $document = json_decode($differentReview->startingPost->message, true);

        $this->expectException(InvariantException::class);
        BeatmapsetDiscussionReview::update($review, $document, $this->user);
    }

    //endregion

    //region Success Scenarios

    // valid document containing issue embeds
    public function testUpdateDocumentValidWithIssues()
    {
        $review = $this->setUpReview();
        $linkedIssue = BeatmapDiscussion::where('parent_id', $review->id)->first();

        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();

        $document = json_decode($review->startingPost->message, true);

        BeatmapsetDiscussionReview::update($review, $document, $this->user);

        // ensure number of discussions/issues hasn't changed
        $this->assertSame($discussionCount, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount, BeatmapDiscussionPost::count());

        // ensure issue is still linked correctly
        $this->assertSame($review->id, $linkedIssue->refresh()->parent_id);
    }

    // adding a new embed to an existing issue
    public function testUpdateDocumentWithNewIssue()
    {
        $review = $this->setUpReview();

        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();
        $linkedIssueCount = BeatmapDiscussion::where('parent_id', $review->id)->count();

        $document = json_decode($review->startingPost->message, true);
        $document[] = [
            'type' => 'embed',
            'discussion_type' => 'problem',
            'text' => 'whee',
        ];

        BeatmapsetDiscussionReview::update($review, $document, $this->user);

        // ensure new issue was created
        $this->assertSame($discussionCount + 1, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount + 1, BeatmapDiscussionPost::count());

        // ensure new issue is linked correctly
        $this->assertSame($linkedIssueCount + 1, BeatmapDiscussion::where('parent_id', $review->id)->count());
    }

    public function testUpdateDocumentWithNewIssueShouldDisqualify()
    {
        $gmtUser = User::factory()->withGroup('gmt')->create();
        $beatmapset = Beatmapset::factory()->qualified()->create();
        $beatmapset->beatmaps()->save(Beatmap::factory()->make());
        $review = $this->setUpPraiseOnlyReview($beatmapset, $gmtUser);

        // ensure qualified beatmap is qualified
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['qualified']);

        // ensure we have a user watching, otherwise no notifications will be sent
        $watchingUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $watchingUser->getKey()]);

        $document = json_decode($review->startingPost->message, true);
        $document[] = [
            'type' => 'embed',
            'discussion_type' => 'problem',
            'text' => 'whee',
        ];

        BeatmapsetDiscussionReview::update($review, $document, $gmtUser);

        $beatmapset->refresh();

        // ensure qualified beatmap has been reset to pending
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['pending']);

        // ensure a disqualification notification is dispatched
        Queue::assertPushed(BeatmapsetDisqualify::class);
        $this->runFakeQueue();
        Event::assertDispatched(NewPrivateNotificationEvent::class);
    }

    public function testUpdateDocumentWithNewIssueShouldResetNominations()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmapset->beatmaps()->save(Beatmap::factory()->make());

        $playmode = $beatmapset->playmodesStr()[0];
        $natUser = User::factory()->withGroup('nat', [$playmode])->create();
        $review = $this->setUpPraiseOnlyReview($beatmapset, $natUser);

        // ensure qualified beatmap is pending
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['pending']);

        // ensure beatmapset has a nominationBeatmapsetCompactTransformer.php
        $beatmapset->nominate($natUser, [$playmode]);
        $this->assertSame($beatmapset->currentNominationCount()[$playmode], 1);

        // ensure we have a user watching, otherwise no notifications will be sent
        $watchingUser = User::factory()->create();
        $beatmapset->watches()->create(['user_id' => $watchingUser->getKey()]);

        $document = json_decode($review->startingPost->message, true);
        $document[] = [
            'type' => 'embed',
            'discussion_type' => 'problem',
            'text' => 'whee',
        ];

        BeatmapsetDiscussionReview::update($review, $document, $natUser);

        $beatmapset->refresh();

        // ensure beatmap is still pending
        $this->assertSame($beatmapset->approved, Beatmapset::STATES['pending']);
        // ensure nomination count has been reset
        $this->assertSame($beatmapset->currentNominationCount()[$playmode], 0);

        // ensure a nomination reset notification is dispatched
        Queue::assertPushed(BeatmapsetResetNominations::class);
        $this->runFakeQueue();
        Event::assertDispatched(NewPrivateNotificationEvent::class);
    }

    /**
     * @dataProvider dataProviderForQualifiedProblem
     */
    public function testUpdateDocumentWithNewIssueShouldNotifyIfQualified($state, $shouldNotify)
    {
        $gmtUser = User::factory()->withGroup('gmt')->create();
        $beatmapset = Beatmapset::factory()->$state()->create();
        $beatmapset->beatmaps()->save(Beatmap::factory()->make(['playmode' => 0]));

        $notificationOption = $gmtUser->notificationOptions()->firstOrCreate([
            'name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
        ]);
        $notificationOption->update(['details' => ['modes' => ['osu']]]);

        $review = $this->setUpPraiseOnlyReview($beatmapset, $gmtUser);

        // ensure qualified beatmap is qualified
        $this->assertSame($beatmapset->status(), $state);

        $document = json_decode($review->startingPost->message, true);
        $document[] = [
            'type' => 'embed',
            'discussion_type' => 'problem',
            'text' => 'whee',
        ];

        BeatmapsetDiscussionReview::update($review, $document, $this->user);

        $beatmapset->refresh();

        // ensure beatmap status hasn't changed.
        $this->assertSame($beatmapset->status(), $state);

        if ($shouldNotify) {
            // ensure a new problem notification is dispatched
            Queue::assertPushed(BeatmapsetDiscussionQualifiedProblem::class);
            $this->runFakeQueue();
            Event::assertDispatched(NewPrivateNotificationEvent::class);
        } else {
            Queue::assertNotPushed(BeatmapsetDiscussionQualifiedProblem::class);
            $this->runFakeQueue();
            Event::assertNotDispatched(NewPrivateNotificationEvent::class);
        }
    }

    // removing/unlinking an embed from an existing issue
    public function testUpdateDocumentRemoveIssue()
    {
        $review = $this->setUpReview();

        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();

        $document = json_decode($review->startingPost->message, true);
        $issue = array_shift($document); // drop the first issue

        BeatmapsetDiscussionReview::update($review, $document, $this->user);

        // ensure number of discussions/issues hasn't changed
        $this->assertSame($discussionCount, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount, BeatmapDiscussionPost::count());

        $unlinked = BeatmapDiscussion::find($issue['discussion_id']);

        // ensure embed is no longer in message
        $this->assertStringNotContainsString((string) $unlinked->id, $review->startingPost->message);

        // ensure parent_id is removed from child issue
        $this->assertNull($unlinked->parent_id);
    }

    //endregion

    //endregion

    public function dataProviderForQualifiedProblem()
    {
        return [
            ['qualified', true],
            ['pending', false],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();

        config()->set('osu.beatmapset.discussion_review_max_blocks', 4);

        $this->user = User::factory()->create();
        $this->beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(Beatmap::factory()->make());
    }

    protected function setUpReview($beatmapset = null): BeatmapDiscussion
    {
        $timestampedIssueText = '00:01:234 '.self::$faker->sentence();
        $issueText = self::$faker->sentence();

        return BeatmapsetDiscussionReview::create(
            $beatmapset ?? $this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $timestampedIssueText,
                    'timestamp' => true,
                    'beatmap_id' => $this->beatmap->getKey(),
                ],
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $issueText,
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $this->user
        );
    }

    protected function setUpPraiseOnlyReview($beatmapset = null, $user = null): BeatmapDiscussion
    {
        return BeatmapsetDiscussionReview::create(
            $beatmapset ?? $this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'praise',
                    'text' => self::$faker->sentence(),
                ],
                [
                    'type' => 'paragraph',
                    'text' => 'this is some paragraph text',
                ],
            ],
            $user ?? $this->user
        );
    }

    protected function updateReview($document)
    {
        $review = $this->setUpReview();
        BeatmapsetDiscussionReview::update($review, $document, $this->user);
    }
}
