<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Pager\Pager;

final class PagerTest extends TestCase
{
    /** @test */
    public function previousPageIsEqualZeroWhenCurrentPageIsOne(): void
    {
        $pager = new Pager(10, 5);
        $this->assertEquals(0, $pager->getPreviousPage());
    }

    /** @test */
    public function nextPageIsEqualZeroWhenCurrentPageIsLast(): void
    {
        $pager = new Pager(10, 5);
        $pager->setPageAsCurrent(2);
        $this->assertEquals(0, $pager->getNextPage());
    }

    /** @test */
    public function pageNumberIsAlwaysInteger()
    {
        $pager = new Pager(10, 3);
        $this->assertIsInt($pager->getNumberOfPages());
    }
}
