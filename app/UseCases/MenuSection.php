<?php

namespace App\UseCases;

class MenuSection
{
    protected $section;

    protected $items = [];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param MenuItems $item
     * @return MenuSection
     */
    public function addItem(MenuItems $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param $section
     * @return MenuSection
     */
    public function setSection($section): self
    {
        $this->section = $section;

        return $this;
    }

}
