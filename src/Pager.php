<?php

declare(strict_types=1);

namespace Pager;

use Exception;

class Pager
{
    protected $numberOfObjects;
    protected $objectsPerPage;
    protected $currentPage;
    protected $previousPage;
    protected $nextPage;
    protected $numberOfPages;

    public function __construct(int $numberOfObjects, int  $objectsPerPage)
    {
        if ($numberOfObjects <= 0 || $objectsPerPage <= 0) {
            throw new Exception('your input must be greater than 0');
        }
        $this->numberOfObjects = $numberOfObjects;
        $this->objectsPerPage = $objectsPerPage;
        $this->numberOfPages = intval($numberOfObjects / $objectsPerPage);
        $this->currentPage = 1;
        $this->setPreviousPage();
        $this->setNextpage();
    }

    public function setPageAsCurrent(int $pageNumber): void
    {
        if ($pageNumber < 1 || $this->numberOfPages < $pageNumber) {
            throw new Exception($pageNumber.' not exists');
        } else {
            $this->currentPage = $pageNumber;
            $this->setPreviousPage();
            $this->setNextpage();
        }
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }

    public function displayPagination(): array
    {
        $pages = ['first_page' => 1, 'last_page' => $this->numberOfPages, 'current_page' => $this->currentPage];
        if ($this->getPreviousPage()) {
            $pages['previous_page'] = $this->getPreviousPage();
        }
        if ($this->getNextPage()) {
            $pages['next_page'] = $this->getNextPage();
        }

        return $pages;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getPreviousPage(): int
    {
        return $this->previousPage;
    }

    public function getNextPage(): int
    {
        return $this->nextPage;
    }

    private function setPreviousPage(): void
    {
        if ($this->currentPage - 1 <= 0) {
            $this->previousPage = 0;
        } else {
            $this->previousPage = $this->currentPage - 1;
        }
    }

    private function setNextPage(): void
    {
        if ($this->currentPage + 1 > $this->numberOfPages) {
            $this->nextPage = 0;
        } else {
            $this->nextPage = $this->currentPage + 1;
        }
    }
}
