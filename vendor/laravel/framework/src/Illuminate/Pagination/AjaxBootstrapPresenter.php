<?php namespace Illuminate\Pagination;

class AjaxBootstrapPresenter extends Presenter {

	protected $function;

	function __construct(Paginator $paginator,$function){
		$this->function = $function;
		parent::__construct($paginator);
	}
	
    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @return string
     */
    public function getPageLinkWrapper($url, $page) {
		if(is_string($page)){
			if(ord($page[1])==114){
				return '<li><a style="cursor: pointer;" onclick="' . $this->function . '(' . ($this->currentPage+1) . ')">' . $page . '</a></li>';
			}
			elseif(ord($page[1])==108){
				return '<li><a style="cursor: pointer;" onclick="' . $this->function . '(' . ($this->currentPage-1) . ')">' . $page . '</a></li>';
			}
		}
        return '<li><a style="cursor: pointer;" onclick="' . $this->function . '(' . $page . ')">' . $page . '</a></li>';
    }
	
    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    public function getDisabledTextWrapper($text) {
        return '<li class="disabled"><span>' . $text . '</span></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    public function getActivePageWrapper($text) {
        return '<li class="active"><span>' . $text . '</span></li>';
    }

}