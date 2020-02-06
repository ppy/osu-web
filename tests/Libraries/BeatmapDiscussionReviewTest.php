<?php

namespace Tests;

use App\Exceptions\InvariantException;
use App\Libraries\BeatmapDiscussionReview;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\User;
use Faker;

class BeatmapDiscussionReviewTest extends TestCase
{
    protected static $faker;
    protected $beatmap;
    protected $beatmapset;
    protected $user;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Faker\Factory::create();
    }

    // empty document
    public function testPostReviewDocumentEmpty()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset, [], $this->user);
    }

    // missing block type
    public function testPostReviewDocumentMissingBlockType()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'text' => 'invalid lol',
                ],
            ], $this->user);
    }

    // invalid block type
    public function testPostReviewDocumentInvalidBlockType()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'type' => 'invalid lol',
                ],
            ], $this->user);
    }

    // invalid paragraph block
    public function testPostReviewDocumentInvalidParagraphBlockContent()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'type' => 'paragraph',
                ],
            ], $this->user);
    }

    // invalid embed block
    public function testPostReviewDocumentInvalidEmbedBlockContent()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'type' => 'embed',
                ],
            ], $this->user);
    }

    // valid document containing zero issue embeds
    public function testPostReviewDocumentValidParagraphWithNoIssues()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'type' => 'paragraph',
                    'text' => 'this is a text',
                ],
            ], $this->user);
    }

    // document with too many blocks
    public function testPostReviewDocumentValidWithTooManyBlocks()
    {
        $this->expectException(InvariantException::class);
        BeatmapDiscussionReview::create($this->beatmapset,
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
            ], $this->user);
    }

    // posting reviews - success scenarios ----

    // valid document containing issue embeds
    public function testPostReviewDocumentValidWithIssues()
    {
        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();
        $timestampedIssueText = '00:01:234 ' . self::$faker->sentence();
        $issueText = self::$faker->sentence();

        BeatmapDiscussionReview::create($this->beatmapset,
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
            ], $this->user);

        $discussionJson = json_encode($this->beatmapset->defaultDiscussionJson());
        $this->assertStringContainsString("\"message\":\"{$timestampedIssueText}\"", $discussionJson);
        $this->assertStringContainsString('"timestamp":1234', $discussionJson);
        $this->assertStringContainsString("\"message\":\"{$issueText}\"", $discussionJson);

        // ensure 3 discussions/posts are created - one for the review and one for each embedded problem
        $this->assertSame($discussionCount + 3, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount + 3, BeatmapDiscussionPost::count());
    }

    // valid document containing attempted discussion embed injection
    public function testPostReviewDocumentEscaping()
    {
        $discussionCount = BeatmapDiscussion::count();
        $discussionPostCount = BeatmapDiscussionPost::count();
        $issueText = self::$faker->sentence();
        $problematicText = '%[](#123)';
        $problematicTextEscaped = '%\\\[\\\]\\\(#123\\\)';

        BeatmapDiscussionReview::create($this->beatmapset,
            [
                [
                    'type' => 'embed',
                    'discussion_type' => 'problem',
                    'text' => $issueText,
                ],
                [
                    'type' => 'paragraph',
                    'text' => $problematicText,
                ],
            ], $this->user);

        $discussionJson = json_encode($this->beatmapset->defaultDiscussionJson());
        $this->assertStringNotContainsString($problematicText, $discussionJson);
        $this->assertStringContainsString($problematicTextEscaped, $discussionJson);

        // ensure 2 discussions/posts are created - one for the review and one for the embedded problem
        $this->assertSame($discussionCount + 2, BeatmapDiscussion::count());
        $this->assertSame($discussionPostCount + 2, BeatmapDiscussionPost::count());
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.beatmapset.discussion_review_enabled', true);
        config()->set('osu.beatmapset.discussion_review_max_blocks', 3);

        $this->user = factory(User::class)->create();
        $this->beatmapset = factory(Beatmapset::class)->create([
            'discussion_enabled' => true,
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $this->beatmap = $this->beatmapset->beatmaps()->save(factory(Beatmap::class)->make());
    }
}
