<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateWaterserviceRequest;
use App\Http\Requests\UpdateWaterserviceRequest;
use App\Repositories\WaterserviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WaterserviceController extends AppBaseController
{
    /** @var  WaterserviceRepository */
    private $waterserviceRepository;

    public function __construct(WaterserviceRepository $waterserviceRepo)
    {
        $this->waterserviceRepository = $waterserviceRepo;
    }

    /**
     * Display a listing of the Waterservice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->waterserviceRepository->pushCriteria(new RequestCriteria($request));
        $waterservices = $this->waterserviceRepository->all();

        return view('waterservices.index')
            ->with('waterservices', $waterservices);
    }

    /**
     * Show the form for creating a new Waterservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('waterservices.create');
    }

    /**
     * Store a newly created Waterservice in storage.
     *
     * @param CreateWaterserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateWaterserviceRequest $request)
    {
        $input = $request->all();

        $waterservice = $this->waterserviceRepository->create($input);

        Flash::success('Waterservice saved successfully.');

        return redirect(route('admin.waterservices.index'));
    }

    /**
     * Display the specified Waterservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $waterservice = $this->waterserviceRepository->findWithoutFail($id);

        if (empty($waterservice)) {
            Flash::error('Waterservice not found');

            return redirect(route('admin.waterservices.index'));
        }

        return view('waterservices.show')->with('waterservice', $waterservice);
    }

    /**
     * Show the form for editing the specified Waterservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $waterservice = $this->waterserviceRepository->findWithoutFail($id);

        if (empty($waterservice)) {
            Flash::error('Waterservice not found');

            return redirect(route('admin.waterservices.index'));
        }

        return view('waterservices.edit')->with('waterservice', $waterservice);
    }

    /**
     * Update the specified Waterservice in storage.
     *
     * @param  int              $id
     * @param UpdateWaterserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWaterserviceRequest $request)
    {
        $waterservice = $this->waterserviceRepository->findWithoutFail($id);

        if (empty($waterservice)) {
            Flash::error('Waterservice not found');

            return redirect(route('admin.waterservices.index'));
        }

        $waterservice = $this->waterserviceRepository->update($request->all(), $id);

        Flash::success('Waterservice updated successfully.');

        return redirect(route('admin.waterservices.index'));
    }

    /**
     * Remove the specified Waterservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $waterservice = $this->waterserviceRepository->findWithoutFail($id);

        if (empty($waterservice)) {
            Flash::error('Waterservice not found');

            return redirect(route('admin.waterservices.index'));
        }

        $this->waterserviceRepository->delete($id);

        Flash::success('Waterservice deleted successfully.');

        return redirect(route('admin.waterservices.index'));
    }
}
