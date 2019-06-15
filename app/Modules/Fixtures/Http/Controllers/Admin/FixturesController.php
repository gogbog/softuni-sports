<?php

namespace App\Modules\Fixtures\Http\Controllers\Admin;


use App\Modules\Fixtures\Forms\FixtureForm;
use App\Modules\fixtures\Forms\SportForm;
use App\Modules\Fixtures\Http\Requests\StoreFixtureRequest;
use App\Modules\fixtures\Http\Requests\StoreSportRequest;
use App\Modules\Fixtures\Models\Fixture;
use App\Modules\fixtures\Models\Sport;
use Charlotte\Administration\Helpers\Administration;
use Charlotte\Administration\Helpers\AdministrationDatatable;
use Charlotte\Administration\Helpers\AdministrationField;
use Charlotte\Administration\Helpers\AdministrationForm;
use Charlotte\Administration\Http\Controllers\BaseAdministrationController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class FixturesController extends BaseAdministrationController
{
    /**
     * Display a listing of the resource.
     *
     * @param DataTables $datatable
     * @return Response
     */
    public function index(DataTables $datatable)
    {

        $columns = [
            'id' => ['title' => trans('fixtures::admin.id'), 'orderable' => false],
            'title' => ['title' => trans('fixtures::admin.title'), 'orderable' => false],
//            'league' => ['title' => trans('fixtures::admin.league'), 'orderable' => false],
            'homeTeamOdds' => ['title' => trans('fixtures::admin.homeTeamOdds'), 'orderable' => false],
            'awayTeamOdds' => ['title' => trans('fixtures::admin.awayTeamOdds'), 'orderable' => false],
            'drawOdds' => ['title' => trans('fixtures::admin.drawOdds'), 'orderable' => false],
            'visible' => ['title' => trans('fixtures::admin.visible'), 'orderable' => false],
            'created_at' => ['title' => trans('fixtures::admin.created_at'), 'orderable' => false],
            'action' => ['title' => trans('fixtures::admin.action'), 'orderable' => false]
        ];

        $table = new AdministrationDatatable($datatable);
        $table->query(Fixture::withTrashed()->with(['league', 'league.sport'])->reversed());
        $table->columns($columns);
        $table->addColumn('visible', function ($fixture) {
            return AdministrationField::switch('visible', $fixture);
        });
        $table->editColumn('title', function ($fixture) {
            if (strlen($fixture->title) > 40) {
                return substr($fixture->title, 0, 40) . '...';
            }

            return $fixture->title;
        });
        $table->addColumn('league', function ($fixture) {
            if (!empty($fixture->league)) {
                return $fixture->league->title;
            }
            return 'none';
        });
        $table->addColumn('action', function ($fixture) {
            $action = AdministrationField::edit(Administration::route('fixtures.edit', $fixture->id));

            if (empty($fixture->deleted_at)) {
                $action .= AdministrationField::delete(Administration::route('fixtures.destroy', $fixture->id));
            } else {
                $action .= AdministrationField::restore(Administration::route('fixtures.destroy', $fixture->id));
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


        Administration::setTitle(trans('fixtures::admin.module_name'));
        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('fixtures::admin.module_name'));
        });

        return $table->generate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = new AdministrationForm();
        $form->route(Administration::route('fixtures.store'));
        $form->form(FixtureForm::class);

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('fixtures::admin.module_name'), Administration::route('fixtures.index'));
            $breadcrumbs->push(trans('administration::admin.create'), Administration::route('fixtures.create'));
        });

        Administration::setTitle(trans('fixtures::admin.sport') . ' - ' . trans('administration::admin.create'));

        return $form->generate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFixtureRequest $request
     * @return Response
     */
    public function store(StoreFixtureRequest $request)
    {
        $fixture = new Fixture();
        $fixture->fill($request->validated());
        $fixture->save();


        return redirect(Administration::route('fixtures.index'))->withSuccess([trans('administration::admin.success_create')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fixture = Fixture::withTrashed()->where('id', $id)->first();
        if (empty($fixture)) {
            abort(404);
        }

        $form = new AdministrationForm();
        $form->route(Administration::route('fixtures.update', $fixture->id));
        $form->form(FixtureForm::class);
        $form->model($fixture);
        $form->method('PUT');

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('fixtures::admin.module_name'), Administration::route('fixtures.index'));
            $breadcrumbs->push(trans('administration::admin.edit'));
        });

        Administration::setTitle(trans('fixtures::admin.sport') . ' - ' . trans('administration::admin.edit') . ' #' . $fixture->id);

        return $form->generate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param StoreFixtureRequest $request
     * @return Response
     */
    public function update($id, StoreFixtureRequest $request)
    {
        $fixture = Fixture::withTrashed()->where('id', $id)->first();

        if (empty($fixture)) {
            abort(404);
        }

        $fixture->fill($request->validated());
        $fixture->save();



        return redirect(Administration::route('fixtures.index'))->withSuccess([trans('administration::admin.success_update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {

        $fixture = Fixture::withTrashed()->where('id', $id)->first();

        if (!empty($fixture->deleted_at)) {
            $fixture->restore();
        } else {
            $fixture->delete();
        }

        return response()->json();
    }
}
