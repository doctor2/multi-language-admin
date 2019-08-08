<?php

namespace App\UseCases;

class MenuItems
{
    protected $title;

    protected $url;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return strpos(url()->current(), $this->url) !== false;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return MenuItems
     */
    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return MenuItems
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }
}
