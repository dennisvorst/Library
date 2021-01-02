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
        /** create a db stub */
        $db = $this->createmock(Database::class);

        /** Library must have a stub */
        $object = new Library($db);
        $this->assertInstanceOf(Library::class, $object);
    }
}
?>