<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        $settings = Setting::when(!empty($keyword), function ($query) use ($keyword) {
            $query->where('key', 'LIKE', "%$keyword%")
                ->orWhereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });

        })->orderBy('order', 'desc')
            ->latest()->paginate($perPage);

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $requestData = $this->getFormattedData($request->all());

        $this->validator($requestData)->validate();

        Setting::create($requestData);

        return redirect()->route('admin.settings.index')->with('flash_message', 'Настройка добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id)
    {
        $setting = $this->findOrFailWithTranslation($id);

        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit($id)
    {
        $setting = $this->findOrFailWithTranslation($id);

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $this->getFormattedData($request->all());
        $requestData['id'] = $id;

        $this->validator($requestData)->validate();

        $setting = Setting::findOrFail($id);

        $setting->update($requestData);

        return redirect()->route('admin.settings.index')->with('flash_message', 'Настройка обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Setting::destroy($id);

        return redirect()->route('admin.settings.index')->with('flash_message', 'Настройка удалена!');
    }

    protected function validator(array $data)
    {
        $checking = '';
        if (isset($data['id'])) {
            $checking = ',key,' . $data['id'];
        }

        return Validator::make($data, [
            'key' => 'required|string|unique:settings' . $checking,
            'ru_name' => 'required',
        ]);
    }

    protected function getFormattedData($request)
    {
        $data = $request;
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $data[$lang] = [
                'name' => $request[$lang . '_name'] ?? '',
            ];
        }

        return $data;
    }

    protected function findOrFailWithTranslation($id)
    {
        $setting = Setting::findOrFail($id);

        $setting->ru_name = $setting->translate(config('custom.language_ru'))->name;
        $setting->en_name = $setting->translate(config('custom.language_en'))->name;

        return $setting;
    }
}
