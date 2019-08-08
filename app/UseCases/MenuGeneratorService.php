<?php

namespace App\UseCases;

class MenuGeneratorService
{
    public static function generateMenu()
    {
        $menu = [];
        $section = new MenuSection();
        $section->setSection("Таблицы")
            ->addItem(
                (new MenuItems())
                    ->setTitle('Проекты')
                    ->setUrl(route('admin.projects.index'))
            )->addItem(
                (new MenuItems())
                    ->setTitle('Города')
                    ->setUrl(route('admin.cities.index'))
            );

        $menu[] = $section;

        $section = new MenuSection();
        $section->setSection("Настройки и лог")
            ->addItem(
                (new MenuItems())
                    ->setTitle('Лог активости')
                    ->setUrl(route('admin.activitylogs.index'))
            )
            ->addItem(
                (new MenuItems())
                    ->setTitle('Настройки')
                    ->setUrl(route('admin.settings.index'))
            )
        ;
        $menu[] = $section;

        return $menu;
    }
}
