<?php

/**
 * Used For Implementing pagination 
 * @category library
 * @package Pagination
 */
class Pagination {

    /**
     * Current page
     * @var int
     */
    public $current_page;
    /**
     * Number of records for the page
     * @var int
     */
    public $per_page;
    /**
     * total no of the records
     * @var int
     */
    public $total_count = 0;

    /**
     * intiaizes the counts
     * @param int $page
     * @param int $per_page
     * @param int $total_count 
     */
    function __construct($page=1, $per_page=20, $total_count=1) {
        if ($page < 1) {
            $page = 1;
        }
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;

        $this->total_count = (int) $total_count;
    }

    /**
     * returns the offset of the result
     * @return int
     */
    public function offset() {
        return ($this->current_page - 1) * $this->per_page;
    }

    /**
     * retunrs total number of pages
     * @return int
     */
    public function totalpages() {
        return ceil($this->total_count / $this->per_page);
    }

    /**
     * returns the next page
     * @return int
     */
    public function nextpage() {
        return $this->current_page + 1;
    }

    /**
     * returns the previous page
     * @return int
     */
    public function prevpage() {
        return $this->current_page - 1;
    }

    /**
     * returns whether it has next page
     * @return bool
     */
    public function has_nextpage() {
        return $this->nextpage() <= $this->totalpages() ? true : false;
    }

    /**
     *  returns whether it has previous page
     * @return int
     */
    public function has_prevpage() {
        return $this->prevpage() >= 1 ? true : false;
    }

}

