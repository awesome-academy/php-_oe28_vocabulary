<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\TestController;
use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Mockery as M;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Test;

class TestControllerTest extends TestCase
{
    protected $testMock;
    protected $testController;

    public function setUp(): void
    {
        $this->testMock = M::mock(TestRepositoryInterface::class);
        $this->testController = new TestController($this->testMock);
        parent::setUp();
    }

    public function tearDown(): void
    {
        unset($this->testController);
        M::close();
        parent::tearDown();
    }

    public function testIndexFunction()
    {
        $this->testMock
            ->shouldReceive('getAllTests')
            ->once()
            ->andReturn([]);
        $result= $this->testController->index();
        $data = $result->getData();
        $this->assertEquals('history', $result->getName());
        $this->assertArrayHasKey('tests', $data);
    }

    public function testCreateFunction()
    {
        $this->testMock
            ->shouldReceive('getAllTypes')
            ->once()
            ->andReturn([]);
        $this->testMock
            ->shouldReceive('getAllDates')
            ->once()
            ->andReturn(new Collection());
        $result = $this->testController->create();
        $data = $result->getData();
        $this->assertEquals('tests', $result->getName());
        $this->assertArrayHasKey('types', $data);
        $this->assertArrayHasKey('dates', $data);
    }

    public function testStoreFunctionWithEnglishLanguage()
    {
        config(['app.locale' => 'en']);
        $data = [
            "test" => "test",
            "level" => "1",
            "total" => "10",
            "types" => [
                0 => "Noun",
                1 => "Verb",
                2 => "Adverb"
            ],
            "dates" => [
                0 => "11/27/2020",
                1 => "11/30/2020",
                2 => "12/08/2020",
                3 => "01/05/2021",
            ]
        ];
        $request = M::mock(Request::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($data);
        $types = [
            0 => "1",
            1 => "2",
            2 => "4"
        ];
        $dates = [
            0 => "2020-11-27",
            1 => "2020-11-30",
            2 => "2020-12-08",
            3 => "2021-01-05"
        ];
        $words = collect(['word']);
        $this->testMock
            ->shouldReceive('createWordsForATest')
            ->with($types, $dates, $data['total'])
            ->once()
            ->andReturn($words);
        $test = new Test();
        $test->id = config('unittest.id');
        $this->testMock
            ->shouldReceive('createATest')
            ->once()
            ->andReturn($test);
        $this->testMock
            ->shouldReceive('attachAWordToTestWordTable')  
            ->once()
            ->andReturn(true);
        $result = $this->testController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('tests.show', $test->id), $result->headers->get('Location'));
    }

    public function testStoreFunctionWithVietnameseLanguage()
    {
        config(['app.locale' => 'vi']);
        $data = [
            "test" => "test",
            "level" => "1",
            "total" => "10",
            "types" => [
                0 => "Danh từ",
                1 => "Động từ",
                2 => "Trạng từ"
            ],
            "dates" => [
                0 => "27/11/2020",
                1 => "30/11/2020",
                2 => "08/12/2020",
                3 => "05/01/2021",
            ]
        ];
        $request = M::mock(Request::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($data);
        $types = [
            0 => "1",
            1 => "2",
            2 => "4"
        ];
        $dates = [
            0 => "2020-11-27",
            1 => "2020-11-30",
            2 => "2020-12-08",
            3 => "2021-01-05"
        ];
        $words = collect(['word']);
        $this->testMock
            ->shouldReceive('createWordsForATest')
            ->with($types, $dates, $data['total'])
            ->once()
            ->andReturn($words);
        $test = new Test();
        $test->id = config('unittest.id');
        $this->testMock
            ->shouldReceive('createATest')
            ->once()
            ->andReturn($test);
        $this->testMock
            ->shouldReceive('attachAWordToTestWordTable')  
            ->once()
            ->andReturn(true);
        $result = $this->testController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('tests.show', $test->id), $result->headers->get('Location'));
    }

    public function testShowFunction()
    {
        $id = config('unittest.id');
        $request = M::mock(Request::class);
        $this->testMock
            ->shouldReceive('getATestWith')
            ->with($id, 'words.types')
            ->once()
            ->andReturn([]);
        $result= $this->testController->show($request, $id);
        $data = $result->getData();
        $this->assertEquals('view_test', $result->getName());
        $this->assertArrayHasKey('test', $data);
    }

    public function testEditFunction()
    {
        $id = config('unittest.id');
        $this->testMock
            ->shouldReceive('getATestWith')
            ->with($id, 'words')
            ->once()
            ->andReturn([]);
        $result= $this->testController->edit($id);
        $data = $result->getData();
        $this->assertEquals('details', $result->getName());
        $this->assertArrayHasKey('test', $data);
    }

    public function testDestroyFunction()
    {
        $id = config('unittest.id');
        $this->testMock
            ->shouldReceive('destroyATest')
            ->with($id)
            ->once()
            ->andReturn(true);
        $result= $this->testController->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
    }

    public function testUpdateFunction()
    {
        $data = [
            "keys" => [ 
                0 => config('unittest.answer')
            ],
            "wordIds" => [
                0 => '8'
            ],
            "typeIds" => [
                0 => '4'
            ],
            "answers" => [
                0 => [
                    0 => "L",
                    1 => "O",
                    2 => "V",
                    3 => "E",
                    4 => "L",
                    5 => "Y",
                ]
            ]
        ]; 
        $id = config('unittest.id');
        $request = M::mock(Request::class);
        $request->shouldReceive('all')
            ->once()
            ->andReturn($data);
        $answer = [
            'answer' => config('unittest.answer'),
            'is_true' => 1,
        ];
        $this->testMock
            ->shouldReceive('updateAnswersForATest')
            ->with($id, $data['typeIds'][0], $data['wordIds'][0], $answer)
            ->once()
            ->andReturn(true);
        $score = [
            'score' => 1,
        ];
        $this->testMock
            ->shouldReceive('update')
            ->with($id, $score)  
            ->once()
            ->andReturn(new Test); 
        $result= $this->testController->update($request, $id);
        $datas = $result->getData();
        $this->assertEquals('res_test', $result->getName());
        $this->assertArrayHasKey('score', $datas);
        $this->assertArrayHasKey('total', $datas);
        $this->assertArrayHasKey('id', $datas);
        $this->assertArrayHasKey('name', $datas);
    }
}
