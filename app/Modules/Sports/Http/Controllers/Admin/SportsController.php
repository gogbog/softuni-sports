<?php

namespace App\Modules\Sports\Http\Controllers\Admin;


use App\Modules\Sports\Forms\SportForm;
use App\Modules\Sports\Http\Requests\StoreSportRequest;
use App\Modules\Sports\Models\Sport;
use Charlotte\Administration\Helpers\Administration;
use Charlotte\Administration\Helpers\AdministrationDatatable;
use Charlotte\Administration\Helpers\AdministrationField;
use Charlotte\Administration\Helpers\AdministrationForm;
use Charlotte\Administration\Http\Controllers\BaseAdministrationController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class SportsController extends BaseAdministrationController
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
            'id' => ['title' => trans('sports::admin.id'), 'orderable' => false],
            'title' => ['title' => trans('sports::admin.title'), 'orderable' => false],
            'visible' => ['title' => trans('sports::admin.visible'), 'orderable' => false],
            'created_at' => ['title' => trans('sports::admin.created_at'), 'orderable' => false],
            'action' => ['title' => trans('sports::admin.action'), 'orderable' => false]
        ];

        $table = new AdministrationDatatable($datatable);
        $table->query(Sport::withTrashed()->reversed());
        $table->columns($columns);
        $table->addColumn('visible', function ($sport) {
            return AdministrationField::switch('visible', $sport);
        });
        $table->addColumn('action', function ($sport) {
            $action = AdministrationField::edit(Administration::route('sports.edit', $sport->id));

            if (empty($sport->deleted_at)) {
                $action .= AdministrationField::delete(Administration::route('sports.destroy', $sport->id));
            } else {
                $action .= AdministrationField::restore(Administration::route('sports.destroy', $sport->id));
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


        Administration::setTitle(trans('sports::admin.module_name'));
        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('sports::admin.module_name'));
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
        $form->route(Administration::route('sports.store'));
        $form->form(SportForm::class);

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('sports::admin.module_name'), Administration::route('sports.index'));
            $breadcrumbs->push(trans('administration::admin.create'), Administration::route('sports.create'));
        });

        Administration::setTitle(trans('sports::admin.sport') . ' - ' . trans('administration::admin.create'));

        return $form->generate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSportRequest $request
     * @return Response
     */
    public function store(StoreSportRequest $request)
    {
        $sport = new Sport();
        $sport->fill($request->validated());
        $sport->save();


        return redirect(Administration::route('sports.index'))->withSuccess([trans('administration::admin.success_create')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $sport = Sport::withTrashed()->where('id', $id)->first();
        if (empty($sport)) {
            abort(404);
        }

        $form = new AdministrationForm();
        $form->route(Administration::route('sports.update', $sport->id));
        $form->form(SportForm::class);
        $form->model($sport);
        $form->method('PUT');

        Breadcrumbs::register('administration', function ($breadcrumbs) {
            $breadcrumbs->parent('base');
            $breadcrumbs->push(trans('sports::admin.module_name'), Administration::route('sports.index'));
            $breadcrumbs->push(trans('administration::admin.edit'));
        });

        Administration::setTitle(trans('sports::admin.sport') . ' - ' . trans('administration::admin.edit') . ' #' . $sport->id);

        return $form->generate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param StoreSportRequest $request
     * @return Response
     */
    public function update($id, StoreSportRequest $request)
    {
        $sport = Sport::withTrashed()->where('id', $id)->first();

        if (empty($sport)) {
            abort(404);
        }

        $sport->fill($request->validated());
        $sport->save();



        return redirect(Administration::route('sports.index'))->withSuccess([trans('administration::admin.success_update')]);
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

        $sport = Sport::withTrashed()->where('id', $id)->first();

        if (!empty($sport->deleted_at)) {
            $sport->restore();
        } else {
            $sport->delete();
        }

        return response()->json();
    }
}
