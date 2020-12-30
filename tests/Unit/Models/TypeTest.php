<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Type;
use App\Models\Word;

class TypeTest extends TestCase
{
    protected $type;

    protected function setUp(): void
    {
        parent::setUp();
        $this->type = new Type();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->type);
    }

    public function testWordRelation()
    {
        $this->testBelongsToManyRelation($this->type->words(), 'type_id', 'word_id', Word::class);
    }
}
