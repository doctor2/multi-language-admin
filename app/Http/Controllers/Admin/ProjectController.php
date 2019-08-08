<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\City;
use App\Project;
use App\UseCases\SettingService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProjectController extends Controller
{
    const IMAGE_RESIZE_NAME = 'projectPreview';

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        $projects = Project::when(!empty($keyword), function ($query) use ($keyword) {
            $query->where('year', 'LIKE', "%$keyword%")
                ->orWhereHas('translations', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%")
                        ->orWhere('additional', 'LIKE', "%$keyword%");
                });
        })->orderBy('order', 'desc')
            ->latest()->paginate($perPage);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        list($arLocations, $fieldsName) = $this->getAdditionalInformationForForm();

        return view('admin.projects.create', compact('arLocations', 'fieldsName'));
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

        $project = Project::create($requestData);

        if ($request->hasFile('preview_image')) {
            $project->saveImage([
                'image_name' => 'preview_image',
                'file' => $request->file('preview_image'),
                'resize_setting' => static::IMAGE_RESIZE_NAME
            ]);
        }

        return redirect()->route('admin.projects.index')->with('flash_message', 'Проект добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function show($id)
    {
        $project = $this->findOrFailWithTranslation($id);

        $fieldsName = app()->make(SettingService::class)->getPortfolioSettings();

        return view('admin.projects.show', compact('project', 'fieldsName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function edit($id)
    {
        $project = $this->findOrFailWithTranslation($id);

        list($arLocations, $fieldsName) = $this->getAdditionalInformationForForm();

        return view('admin.projects.edit', compact('project', 'arLocations', 'fieldsName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $this->getFormattedData($request->all());

        $this->validator($requestData)->validate();

        $project = Project::findOrFail($id);

        $project->update($requestData);

        if ($request->hasFile('preview_image')) {
            $project->saveOrUpdateByName([
                'file' => $request->file('preview_image'),
                'old_image_path' => $project->preview_image_path,
                'image_name' => 'preview_image',
                'resize_setting' => static::IMAGE_RESIZE_NAME,
            ]);
        }

        return redirect()->route('admin.projects.index')->with('flash_message', 'Проект обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect()->route('admin.projects.index')->with('flash_message', 'Проект удалени!');
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
            'ru_title' => 'required',
            'ru_additional' => 'required',
            'year' => 'required',
            'city_id' => 'required',
            'preview_image' => 'sometimes|required|image|mimes:jpg,jpeg,png',
            'order' => 'integer'
        ]);
    }

    protected function getFormattedData($request)
    {
        $data = $request;
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $data[$lang] = [
                'title' => $request[$lang . '_title'] ?? '',
                'additional' => $request[$lang . '_additional'] ?? '',
                'additional_multi' => $request[$lang . '_additional_multi'] ?? '[]',
            ];
        }

        return $data;
    }

    protected function findOrFailWithTranslation($id)
    {
        $project = Project::findOrFail($id);
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $project_temp = $project->translate($lang);
            $project->{$lang . '_title'} = $project_temp->title;
            $project->{$lang . '_additional'} = $project_temp->additional;
            $project->{$lang . '_additional_multi'} = $project_temp->additional_multi;
        }

        return $project;
    }

    protected function getAdditionalInformationForForm()
    {
        $arLocations = [];

        $cities = City::all();
        foreach($cities as $city){
            $arLocations[$city->id] = $city->translate()->name;
        }

        $fieldsName = app()->make(SettingService::class)->getPortfolioSettings();

        return [$arLocations, $fieldsName];
    }
}
