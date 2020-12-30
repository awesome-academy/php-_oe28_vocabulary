<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function testHasManyRelation($related, $foreignKey, $relation)
    {
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($foreignKey, $relation->getForeignKeyName());
    }

    protected function testBelongsToRelation($related, $foreignKey, $ownerKey, $relation)
    {
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($ownerKey, $relation->getOwnerKeyName());
        $this->assertEquals($foreignKey, $relation->getForeignKeyName());
    }

    protected function testBelongsToManyRelation($relation, $foreignPivotKey, $relatedPivotKey, $related)
    {
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertInstanceOf($related, $relation->getRelated());
        $this->assertEquals($foreignPivotKey, $relation->getForeignPivotKeyName());
        $this->assertEquals($relatedPivotKey, $relation->getRelatedPivotKeyName());
    }
}
