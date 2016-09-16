<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateInternetserviceRequest;
use App\Http\Requests\UpdateInternetserviceRequest;
use App\Repositories\InternetserviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InternetserviceController extends AppBaseController
{
    /** @var  InternetserviceRepository */
    private $internetserviceRepository;

    public function __construct(InternetserviceRepository $internetserviceRepo)
    {
        $this->internetserviceRepository = $internetserviceRepo;
    }

    /**
     * Display a listing of the Internetservice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->internetserviceRepository->pushCriteria(new RequestCriteria($request));
        $internetservices = $this->internetserviceRepository->all();

        return view('internetservices.index')
            ->with('internetservices', $internetservices);
    }

    /**
     * Show the form for creating a new Internetservice.
     *
     * @return Response
     */
    public function create()
    {
        return view('internetservices.create');
    }

    /**
     * Store a newly created Internetservice in storage.
     *
     * @param CreateInternetserviceRequest $request
     *
     * @return Response
     */
    public function store(CreateInternetserviceRequest $request)
    {
        $input = $request->all();

        $internetservice = $this->internetserviceRepository->create($input);

        Flash::success('Internetservice saved successfully.');

        return redirect(route('admin.internetservices.index'));
    }

    /**
     * Display the specified Internetservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $internetservice = $this->internetserviceRepository->findWithoutFail($id);

        if (empty($internetservice)) {
            Flash::error('Internetservice not found');

            return redirect(route('admin.internetservices.index'));
        }

        return view('internetservices.show')->with('internetservice', $internetservice);
    }

    /**
     * Show the form for editing the specified Internetservice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $internetservice = $this->internetserviceRepository->findWithoutFail($id);

        if (empty($internetservice)) {
            Flash::error('Internetservice not found');

            return redirect(route('admin.internetservices.index'));
        }

        return view('internetservices.edit')->with('internetservice', $internetservice);
    }

    /**
     * Update the specified Internetservice in storage.
     *
     * @param  int              $id
     * @param UpdateInternetserviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInternetserviceRequest $request)
    {
        $internetservice = $this->internetserviceRepository->findWithoutFail($id);

        if (empty($internetservice)) {
            Flash::error('Internetservice not found');

            return redirect(route('admin.internetservices.index'));
        }

        $internetservice = $this->internetserviceRepository->update($request->all(), $id);

        Flash::success('Internetservice updated successfully.');

        return redirect(route('admin.internetservices.index'));
    }

    /**
     * Remove the specified Internetservice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $internetservice = $this->internetserviceRepository->findWithoutFail($id);

        if (empty($internetservice)) {
            Flash::error('Internetservice not found');

            return redirect(route('admin.internetservices.index'));
        }

        $this->internetserviceRepository->delete($id);

        Flash::success('Internetservice deleted successfully.');

        return redirect(route('admin.internetservices.index'));
    }
}
