<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateTvserviceRequest;
use App\Http\Requests\UpdateTvserviceRequest;
use App\Repositories\TvserviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TvserviceController extends AppBaseController
{
    /** @var  TvserviceRepository */
    private $tvserviceRepository;

    public function __construct(TvserviceRepository $tvserviceRepo)
    {
        $this->tvserviceRepository = $tvserviceRepo;
    }

    /**
     * Display a listing of the Tvservice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tvserviceRepository->pushCriteria(new RequestCriteria($request));
        $tvservices = $this->tvserviceRepository->all();

        return view('tvservices.index')
            ->with('tvservices', $tvservices);
    }

    /**
     * Show the form for creating a new Tvservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('tvservices.create');
    }

    /**
     * Store a newly created Tvservice in storage.
     *
     * @param CreateTvserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateTvserviceRequest $request)
    {
        $input = $request->all();

        $tvservice = $this->tvserviceRepository->create($input);

        Flash::success('Tvservice saved successfully.');

        return redirect(route('admin.tvservices.index'));
    }

    /**
     * Display the specified Tvservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tvservice = $this->tvserviceRepository->findWithoutFail($id);

        if (empty($tvservice)) {
            Flash::error('Tvservice not found');

            return redirect(route('admin.tvservices.index'));
        }

        return view('tvservices.show')->with('tvservice', $tvservice);
    }

    /**
     * Show the form for editing the specified Tvservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tvservice = $this->tvserviceRepository->findWithoutFail($id);

        if (empty($tvservice)) {
            Flash::error('Tvservice not found');

            return redirect(route('admin.tvservices.index'));
        }

        return view('tvservices.edit')->with('tvservice', $tvservice);
    }

    /**
     * Update the specified Tvservice in storage.
     *
     * @param  int              $id
     * @param UpdateTvserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTvserviceRequest $request)
    {
        $tvservice = $this->tvserviceRepository->findWithoutFail($id);

        if (empty($tvservice)) {
            Flash::error('Tvservice not found');

            return redirect(route('admin.tvservices.index'));
        }

        $tvservice = $this->tvserviceRepository->update($request->all(), $id);

        Flash::success('Tvservice updated successfully.');

        return redirect(route('admin.tvservices.index'));
    }

    /**
     * Remove the specified Tvservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tvservice = $this->tvserviceRepository->findWithoutFail($id);

        if (empty($tvservice)) {
            Flash::error('Tvservice not found');

            return redirect(route('admin.tvservices.index'));
        }

        $this->tvserviceRepository->delete($id);

        Flash::success('Tvservice deleted successfully.');

        return redirect(route('admin.tvservices.index'));
    }
}
