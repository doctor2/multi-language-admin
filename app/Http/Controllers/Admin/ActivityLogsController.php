<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $activitylogs = Activity::where('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $activitylogs = Activity::latest()->paginate($perPage);
        }

        return view('admin.activitylogs.index', compact('activitylogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function show($id)
    {
        $activitylog = Activity::findOrFail($id);

        return view('admin.activitylogs.show', compact('activitylog'));
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
        Activity::destroy($id);

        return redirect('admin/activitylogs')->with('flash_message', 'Activity deleted!');
    }
}
