<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Afaqy\LeaveType\Services\LeaveTypeService;
use Afaqy\LeaveType\Http\Requests\LeaveTypeCreateRequest;
use Afaqy\LeaveType\Http\Requests\LeaveTypeUpdateRequest;
use Afaqy\LeaveType\Http\Transformers\LeaveTypeTransformer;

class ProductController extends Controller
{

    public function __construct(LeaveTypeService $service)
    {
        $this->service = $service;
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
    {
        if (request()->ajax()) {
            return $this->indexAjax(request()->all());
        }

        return view('list', [
            'heads'  => config('leave-type.list.heads'),
            'config' => [
                'ajax'       => route('leave-types.index'),
                'order'      => config('leave-type.list.order'),
                'columns'    => config('leave-type.list.columns'),
                'processing' => config('leave-type.list.processing'),
                'serverSide' => config('leave-type.list.serverSide'),
            ],
            'title'  => trans('leave-type::leave-type.leave-type'),
        ]);
    }

    public function indexAjax($request): \Illuminate\Http\JsonResponse
    {
        $recordsTotal    = $this->service->fetch([DB::raw('COUNT(*) as total_count')])->first()->total_count ?? 0;
        $recordsFiltered = $this->service->fetch([DB::raw('COUNT(*) as total_count')], [
            'status' => request('search[value]'),
        ])->first()->total_count ?? 0;
        $leave           = $this->service->fetch(['*'], [
            'offset'    => $request['start'],
            'perPage'   => $request['length'],
            'status'    => $request['search']['value'] ?? null,
            'sort'      => config('leave-type.list.columns') [$request['order'][0]['column']],
            'direction' => $request['order'][0]['dir'],
        ]);

        return $this->returnSuccess(
            '',
            [
                'draw'            => request('draw'),
                'recordsTotal'    => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data'            => $this->fractalCollection($leave, new LeaveTypeTransformer())['data'],
            ],
        );
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('leave-type::form', [
            'title'            => trans('leave-type::leave-type.create-leave-type'),
            'optionsAttachment'=> trans('leave-type::leave-type.options-attachment'),
        ]);
    }

    public function store(LeaveTypeCreateRequest $leaveTypeRequest): \Illuminate\Http\RedirectResponse
    {
        return $this->service->create($leaveTypeRequest->validated()) ?
            back()->with([
                'message'    => trans('messages.create.success', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'success',
            ]) :
            back()->with([
                'message'    => trans('messages.create.failed', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'error',
            ]);
    }

    public function edit($id)
    {
        $leaveType = $this->service->getOne($id);

        return view('leave-type::form', [
            'title'            => trans('leave-type::leave-type.edit-leave-type'),
            'leaveType'        => $leaveType,
            'optionsAttachment'=> trans('leave-type::leave-type.options-attachment'),

        ]);
    }

    public function update(LeaveTypeUpdateRequest $leaveTypeRequest, $id): \Illuminate\Http\RedirectResponse
    {
        $leave = $this->service->update($leaveTypeRequest->validated(), $id);

        return $leave ?
            back()->with([
                'message'    => trans('messages.update.success', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'success',
            ]) :
            back()->with([
                'message'    => trans('messages.update.failed', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'error',
            ]);
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        return $this->service->archive([$id]) ?
            back()->with([
                'message'    => trans('messages.delete.success', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'success',
            ]) :
            back()->with([
                'message'    => trans('messages.delete.failed', ['module' => trans('leave-type::leave-type.leave-type')]),
                'alert-type' => 'error',
            ]);
    }
}
