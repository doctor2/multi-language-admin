<?php

namespace App\UseCases;

use App\Setting;


class SettingService
{
    private $data = [];

    public function getResizeSetting()
    {
        if(isset($this->data['resize'])){
            return $this->data['resize'];
        }

        $settings = Setting::whereIn('key', [
            'projectPreviewWidth',
            'projectPreviewHeight',
        ])->with('translations')->get();

        $this->data['resize'] = [];

        foreach($settings as $setting){
            $this->data['resize'][$setting->key] = (int) trim($setting->name);
        }

        return $this->data['resize'];
    }

    public function getPortfolioSettings()
    {
        if(isset($this->data['portfolio'])){
            return $this->data['portfolio'];
        }
        $settings = Setting::whereIn('key', [
            'portfolioYear',
            'portfolioAdditional'
        ])->with('translations')->get();

        $this->data['portfolio'] = [
             'year' => '','additional' => '',
        ];
        foreach($settings as $setting){
            $key = strtolower(str_replace('portfolio', '', $setting->key));
            $this->data['portfolio'][$key] = $setting->name ?? null;
        }

        return $this->data['portfolio'];
    }

    public function useLocationInProject()
    {
        $this->data['isUsedLocationInProject'] = true;
    }

    public function isUsedLocationInProject()
    {
        return $this->data['isUsedLocationInProject'] ?? false;
    }
}
