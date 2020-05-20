<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Pager\Pager;

final class PagerTest extends TestCase
{
    public function previousPageIsEqualZeroWhenCurrentPageIsOne()
    {
        $pager = new Pager(10, 5);
        $this->assertEquals(0, $pager->getPreviousPage());
    }
}
