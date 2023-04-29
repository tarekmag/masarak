<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    protected $pageTitle;
    protected $haveSearch;
    protected $linkCache;
    protected $haveCalendarSearch;
    protected $pagesBreadcrumb;
    protected $currentPageTitle;
    protected $routePageCreate;
    protected $routeNamePageCreate;
    protected $dataMethodCreate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageTitle, $haveSearch, $linkCache, $haveCalendarSearch, $pagesBreadcrumb, $currentPageTitle, $routePageCreate, $routeNamePageCreate, $dataMethodCreate)
    {
        $this->pageTitle = $pageTitle;
        $this->haveSearch = $haveSearch;
        $this->linkCache = $linkCache;
        $this->haveCalendarSearch = $haveCalendarSearch;
        $this->pagesBreadcrumb = $pagesBreadcrumb;
        $this->currentPageTitle = $currentPageTitle;
        $this->routePageCreate = $routePageCreate;
        $this->routeNamePageCreate = $routeNamePageCreate;
        $this->routeNamePageCreate = $routeNamePageCreate;
        $this->dataMethodCreate = $dataMethodCreate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['pageTitle'] = $this->pageTitle;
        $data['haveSearch'] = $this->haveSearch;
        $data['linkCache'] = $this->linkCache;
        $data['haveCalendarSearch'] = $this->haveCalendarSearch;
        $data['pagesBreadcrumb'] = $this->pagesBreadcrumb;
        $data['currentPageTitle'] = $this->currentPageTitle;
        $data['routePageCreate'] = $this->routePageCreate;
        $data['routeNamePageCreate'] = $this->routeNamePageCreate;
        $data['dataMethodCreate'] = $this->dataMethodCreate;

        return view('components.page-header')->with($data);
    }
}
