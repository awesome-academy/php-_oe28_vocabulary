<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Word;
use App\Models\User;
use App\Models\Type;
use App\Models\Test;

class WordTest extends TestCase
{
    protected $word;

    protected $fillable = [
        'word',
        'note',
    ];

    protected function setUp(): void
    {
        $this->word = new Word();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->word);
        parent::tearDown();
    }

    public function testFillable()
    {
        $this->assertEquals($this->fillable, $this->word->getFillable());
    }

    public function testUserRelation()
    {
        $this->testBelongsToRelation(User::class, 'user_id', 'id', $this->word->user());
    }

    public function testTypeRelation()
    {
        $this->testBelongsToManyRelation($this->word->types(), 'word_id', 'type_id', Type::class);
    }

    public function testTestRelation()
    {
        $this->testBelongsToManyRelation($this->word->tests(), 'word_id', 'test_id', Test::class);
    }

    public function testTheMutator()
    {
        $word = factory(Word::class)->make();

        $this->assertEquals('TEST', $word->word);
    }
}
