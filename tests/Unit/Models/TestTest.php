<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Test;
use App\Models\User;
use App\Models\Word;

class TestTest extends TestCase
{
    protected $test;

    protected $fillable = [
        'test',
        'option_level',
        'score',
        'total',
        'timeout',
    ];

    protected function setUp(): void
    {
        $this->test = new Test();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->test);
        parent::tearDown();
    }

    public function testFillable()
    {
        $this->assertEquals($this->fillable, $this->test->getFillable());
    }

    public function testUserRelation()
    {
        $this->testBelongsToRelation(User::class, 'user_id', 'id', $this->test->user());
    }

    public function testWordRelation()
    {
        $this->testBelongsToManyRelation($this->test->words(), 'test_id', 'word_id', Word::class);
    }
}
