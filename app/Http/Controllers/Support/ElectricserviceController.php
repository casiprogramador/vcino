<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateElectricserviceRequest;
use App\Http\Requests\UpdateElectricserviceRequest;
use App\Repositories\ElectricserviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ElectricserviceController extends AppBaseController
{
    /** @var  ElectricserviceRepository */
    private $electricserviceRepository;

    public function __construct(ElectricserviceRepository $electricserviceRepo)
    {
        $this->electricserviceRepository = $electricserviceRepo;
    }

    /**
     * Display a listing of the Electricservice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->electricserviceRepository->pushCriteria(new RequestCriteria($request));
        $electricservices = $this->electricserviceRepository->all();

        return view('electricservices.index')
            ->with('electricservices', $electricservices);
    }

    /**
     * Show the form for creating a new Electricservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('electricservices.create');
    }

    /**
     * Store a newly created Electricservice in storage.
     *
     * @param CreateElectricserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateElectricserviceRequest $request)
    {
        $input = $request->all();

        $electricservice = $this->electricserviceRepository->create($input);

        Flash::success('Electricservice saved successfully.');

        return redirect(route('admin.electricservices.index'));
    }

    /**
     * Display the specified Electricservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $electricservice = $this->electricserviceRepository->findWithoutFail($id);

        if (empty($electricservice)) {
            Flash::error('Electricservice not found');

            return redirect(route('admin.electricservices.index'));
        }

        return view('electricservices.show')->with('electricservice', $electricservice);
    }

    /**
     * Show the form for editing the specified Electricservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $electricservice = $this->electricserviceRepository->findWithoutFail($id);

        if (empty($electricservice)) {
            Flash::error('Electricservice not found');

            return redirect(route('admin.electricservices.index'));
        }

        return view('electricservices.edit')->with('electricservice', $electricservice);
    }

    /**
     * Update the specified Electricservice in storage.
     *
     * @param  int              $id
     * @param UpdateElectricserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateElectricserviceRequest $request)
    {
        $electricservice = $this->electricserviceRepository->findWithoutFail($id);

        if (empty($electricservice)) {
            Flash::error('Electricservice not found');

            return redirect(route('admin.electricservices.index'));
        }

        $electricservice = $this->electricserviceRepository->update($request->all(), $id);

        Flash::success('Electricservice updated successfully.');

        return redirect(route('admin.electricservices.index'));
    }

    /**
     * Remove the specified Electricservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $electricservice = $this->electricserviceRepository->findWithoutFail($id);

        if (empty($electricservice)) {
            Flash::error('Electricservice not found');

            return redirect(route('admin.electricservices.index'));
        }

        $this->electricserviceRepository->delete($id);

        Flash::success('Electricservice deleted successfully.');

        return redirect(route('admin.electricservices.index'));
    }
}
