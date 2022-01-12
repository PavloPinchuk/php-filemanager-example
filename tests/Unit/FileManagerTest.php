<?php

namespace Tests\Unit;

use App\Packages\FileManager\FileManager;
use App\Packages\FileManager\NotFoundException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileManagerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFileManager()
    {
        $path = __DIR__."/../FileTest";

        $fm = new FileManager($path);
        $list = $fm->list();
        $this->assertTrue(count(array_keys($list)) === 2);
    }

    public function testFileManagerViewException()
    {
        $path = __DIR__."/../FileTest";
        $fm = new FileManager($path);
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("File `example.html` not found!");
        $fm->view("example.html");
    }

    public function testFileManagerView1()
    {
        $path = __DIR__."/../FileTest";
        $fm = new FileManager($path);
        $content = $fm->view("file1.txt");
        $this->assertEquals("example-content\n", $content);
    }

    public function testFileManagerView2()
    {
        $path = __DIR__."/../FileTest";
        $fm = new FileManager($path);
        $res = $fm->view("dir2");
        $this->assertCount(4, array_keys($res));
    }

//    public function testFileManagerView3()
//    {
//        $path = __DIR__."/../FileTest";
//        $fm = new FileManager($path);
//        $content = $fm->view("dir2/file2.txt");
//        $this->assertEquals("file2.txt - content", $content);
//    }

//    public function testFileManagerView4()
//    {
//        $path = __DIR__."/../FileTest";
//        $fm = new FileManager($path);
//        $res = $fm->view("dir2/dir3");
//
//
//        $this->assertCount(5, array_keys($res));
//    }
}
