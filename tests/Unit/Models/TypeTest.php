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
        $this->type = new Type();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->type);
        parent::tearDown();
    }

    public function testWordRelation()
    {
        $this->testBelongsToManyRelation($this->type->words(), 'type_id', 'word_id', Word::class);
    }
}
