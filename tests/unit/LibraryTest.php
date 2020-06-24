<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class HtmlLibraryTest extends TestCase
{
    public function testClassLibraryExists()
    {
        $this->assertTrue(class_exists("Library"));
    }

    public function testClassLibraryCanBeInstantiated()
    {
        $object = new Library();
        $this->assertInstanceOf($object, Library::class);
    }
}
?>