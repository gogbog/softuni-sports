<?php

namespace App\Modules\Leagues\Http\Controllers\Admin;


use App\Modules\Leagues\Forms\LeaguesForm;
use App\Modules\Leagues\Http\Requests\StoreLeagueRequest;
use App\Modules\Leagues\Models\League;
use Charlotte\Administration\Helpers\Administration;
use Charlotte\Administration\Helpers\AdministrationDatatable;
use Charlotte\Administration\Helpers\AdministrationField;
use Charlotte\Administration\Helpers\AdministrationForm;
use Charlotte\Administration\Http\Controllers\BaseAdministrationController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class LeaguesController extends BaseAdministrationController {
    /**
     * Display a listing of the resource.
     *
     * @param DataTables $datatable
     * @return Response
     */
    public function index(DataTables $datatable) {

        $columns = [
            'id' => ['title' => trans('leagues::admin.id'), 'orderable' => false],
            'title' => ['title' => trans('leagues::admin.title'), 'orderable' => false],
            'visible' => ['title' => trans('leagues::admin.visible'), 'orderable' => false],
            'created_at' => ['title' => trans('leagues::admin.created_at'), 'orderable' => false],
            'action' => ['title' => trans('leagues::admin.action'), 'orderable' => false]
        ];

        $table = new AdministrationDatatable($datatable);
        $table->query(League::withTrashed()->reversed());
        $table->columns($columns);
        $table->addColumn('visible', function ($league) {
            return AdministrationField::switch('visible', $league);
        });
        $table->addColumn('action', function ($league) {
            $action = AdministrationField::edit(Administration::route('leagues.edit', $league->id));

            if (empty($league->deleted_at)) {
                $action .= AdministrationField::delete(Administration::route('leagues.destroy', $league->id));
            } else {
                $action .= AdministrationField::restore(Administration::route('leagues.destroy', $league->id));
            }

            return $action;
        });

        $request = $datatable->getRequest();
        $table->filter(function ($query) use ($request) {
            if ($request->has('search')) {
                $query->where('title', 'LIKE', '%' . $request->search["value"] . '%');

            }
        });
        $table->rawColumns(['visible', 'action']);


        Administration::setTitle(trans('leagues::admin.module_name'));
        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('leagues::admin.module_name'));
        });

        return $table->generate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $form = new AdministrationForm();
        $form->route(Administration::route('leagues.store'));
        $form->form(LeaguesForm::class);

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('leagues::admin.module_name'), Administration::route('leagues.index'));
            $breadcrumbs->push(trans('administration::admin.create'), Administration::route('leagues.create'));
        });

        Administration::setTitle(trans('leagues::admin.league') . ' - ' . trans('administration::admin.create'));

        return $form->generate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeagueRequest $request
     * @return Response
     */
    public function store(StoreLeagueRequest $request) {
        $league = new League();
        $league->fill($request->validated());
        $league->save();


        return redirect(Administration::route('leagues.index'))->withSuccess([trans('administration::admin.success_create')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $league = League::withTrashed()->where('id', $id)->first();
        if (empty($league)) {
            abort(404);
        }

        $form = new AdministrationForm();
        $form->route(Administration::route('leagues.update', $league->id));
        $form->form(LeaguesForm::class);
        $form->model($league);
        $form->method('PUT');

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('leagues::admin.module_name'), Administration::route('leagues.index'));
            $breadcrumbs->push(trans('administration::admin.edit'));
        });

        Administration::setTitle(trans('leagues::admin.league') . ' - ' . trans('administration::admin.edit') . ' #' . $league->id);

        return $form->generate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param StoreLeagueRequest $request
     * @return Response
     */
    public function update($id, StoreLeagueRequest $request) {
        $league = League::withTrashed()->where('id', $id)->first();

        if (empty($league)) {
            abort(404);
        }

        $league->fill($request->validated());
        $league->save();


        return redirect(Administration::route('leagues.index'))->withSuccess([trans('administration::admin.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id) {

        $league = League::withTrashed()->where('id', $id)->first();

        if (!empty($league->deleted_at)) {
            $league->restore();
        } else {
            $league->delete();
        }

        return response()->json();
    }
}
