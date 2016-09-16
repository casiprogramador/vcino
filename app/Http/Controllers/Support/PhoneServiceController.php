<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreatePhoneServiceRequest;
use App\Http\Requests\UpdatePhoneServiceRequest;
use App\Repositories\PhoneServiceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PhoneServiceController extends AppBaseController
{
    /** @var  PhoneServiceRepository */
    private $phoneServiceRepository;

    public function __construct(PhoneServiceRepository $phoneServiceRepo)
    {
        $this->phoneServiceRepository = $phoneServiceRepo;
    }

    /**
     * Display a listing of the PhoneService.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->phoneServiceRepository->pushCriteria(new RequestCriteria($request));
        $phoneServices = $this->phoneServiceRepository->all();

        return view('phone_services.index')
            ->with('phoneServices', $phoneServices);
    }

    /**
     * Show the form for creating a new PhoneService.
     *
     * @return Response
     */
    public function create()
    {
        return view('phone_services.create');
    }

    /**
     * Store a newly created PhoneService in storage.
     *
     * @param CreatePhoneServiceRequest $request
     *
     * @return Response
     */
    public function store(CreatePhoneServiceRequest $request)
    {
        $input = $request->all();

        $phoneService = $this->phoneServiceRepository->create($input);

        Flash::success('Phone Service saved successfully.');

        return redirect(route('admin.phoneservices.index'));
    }

    /**
     * Display the specified PhoneService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $phoneService = $this->phoneServiceRepository->findWithoutFail($id);

        if (empty($phoneService)) {
            Flash::error('Phone Service not found');

            return redirect(route('phoneservices.index'));
        }

        return view('phone_services.show')->with('phoneService', $phoneService);
    }

    /**
     * Show the form for editing the specified PhoneService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $phoneService = $this->phoneServiceRepository->findWithoutFail($id);

        if (empty($phoneService)) {
            Flash::error('Phone Service not found');

            return redirect(route('phoneservices.index'));
        }

        return view('phone_services.edit')->with('phoneService', $phoneService);
    }

    /**
     * Update the specified PhoneService in storage.
     *
     * @param  int              $id
     * @param UpdatePhoneServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePhoneServiceRequest $request)
    {
        $phoneService = $this->phoneServiceRepository->findWithoutFail($id);

        if (empty($phoneService)) {
            Flash::error('Phone Service not found');

            return redirect(route('admin.phoneservices.index'));
        }

        $phoneService = $this->phoneServiceRepository->update($request->all(), $id);

        Flash::success('Phone Service updated successfully.');

        return redirect(route('admin.phoneservices.index'));
    }

    /**
     * Remove the specified PhoneService from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $phoneService = $this->phoneServiceRepository->findWithoutFail($id);

        if (empty($phoneService)) {
            Flash::error('Phone Service not found');

            return redirect(route('admin.phoneservices.index'));
        }

        $this->phoneServiceRepository->delete($id);

        Flash::success('Phone Service deleted successfully.');

        return redirect(route('admin.phoneservices.index'));
    }
}
