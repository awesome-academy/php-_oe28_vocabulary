<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Word;
use App\Models\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $user;

    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected function setUp(): void
    {
        $this->user = new User();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }

    public function testFillable()
    {
        $this->assertEquals($this->fillable, $this->user->getFillable());
    }

    public function testHidden()
    {
        $this->assertEquals($this->hidden, $this->user->getHidden());
    }

    public function testWordRelation()
    {
        $this->testHasManyRelation(Word::class, 'user_id', $this->user->words());
    }

    public function testTestRelation()
    {
        $this->testHasManyRelation(Test::class, 'user_id', $this->user->tests());
    }
}
