<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Validator;
use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        $cities = City::when(!empty($keyword), function ($query) use ($keyword) {
            $query->where('value', 'LIKE', "%$keyword%")
                ->orWhereHas('translations', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });

        })->orderBy('order', 'desc')
            ->latest()->paginate($perPage);

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.cities.create');
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

        City::create($requestData);

        return redirect()->route('admin.cities.index')->with('flash_message', 'Город добавлен!');
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
        $city = $this->findOrFailWithTranslation($id);

        return view('admin.cities.show', compact('city'));
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
        $city = $this->findOrFailWithTranslation($id);

        return view('admin.cities.edit', compact('city'));
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

        $this->validator($requestData)->validate();

        $city = City::findOrFail($id);

        $city->update($requestData);

        return redirect()->route('admin.cities.index')->with('flash_message', 'Город обновлен!');
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
        City::destroy($id);

        return redirect()->route('admin.cities.index')->with('flash_message', 'Город удален!');
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ru_name' => 'required',
            'en_name' => 'required',
            'order' => 'integer'
        ]);
    }

    protected function getFormattedData($request)
    {
        $data = $request;
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $data[$lang] = [
                'name' => $request[$lang . '_name'],
            ];
        }

        return $data;
    }

    protected function findOrFailWithTranslation($id)
    {
        $city = City::findOrFail($id);

        $city->ru_name = $city->translate(config('custom.language_ru'))->name;
        $city->en_name = $city->translate(config('custom.language_en'))->name;

        return $city;
    }
}
