<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateSituacionHabitacionalRequest;
use App\Http\Requests\UpdateSituacionHabitacionalRequest;
use App\Repositories\SituacionHabitacionalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SituacionHabitacionalController extends AppBaseController
{
    /** @var  SituacionHabitacionalRepository */
    private $situacionHabitacionalRepository;

    public function __construct(SituacionHabitacionalRepository $situacionHabitacionalRepo)
    {
        $this->situacionHabitacionalRepository = $situacionHabitacionalRepo;
    }

    /**
     * Display a listing of the SituacionHabitacional.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->situacionHabitacionalRepository->pushCriteria(new RequestCriteria($request));
        $situacionHabitacional = $this->situacionHabitacionalRepository->all();

        return view('situacion_habitacional.index')
            ->with('situacionHabitacional', $situacionHabitacional);
    }

    /**
     * Show the form for creating a new SituacionHabitacional.
     *
     * @return Response
     */
    public function create()
    {
        return view('situacion_habitacional.create');
    }

    /**
     * Store a newly created SituacionHabitacional in storage.
     *
     * @param CreateSituacionHabitacionalRequest $request
     *
     * @return Response
     */
    public function store(CreateSituacionHabitacionalRequest $request)
    {
        $input = $request->all();

        $situacionHabitacional = $this->situacionHabitacionalRepository->create($input);

        Flash::success('Situacion Habitacional saved successfully.');

        return redirect(route('admin.situacionHabitacional.index'));
    }

    /**
     * Display the specified SituacionHabitacional.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $situacionHabitacional = $this->situacionHabitacionalRepository->findWithoutFail($id);

        if (empty($situacionHabitacional)) {
            Flash::error('Situacion Habitacional not found');

            return redirect(route('admin.situacionHabitacional.index'));
        }

        return view('situacion_habitacional.show')->with('situacionHabitacional', $situacionHabitacional);
    }

    /**
     * Show the form for editing the specified SituacionHabitacional.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $situacionHabitacional = $this->situacionHabitacionalRepository->findWithoutFail($id);

        if (empty($situacionHabitacional)) {
            Flash::error('Situacion Habitacional not found');

            return redirect(route('admin.situacionHabitacional.index'));
        }

        return view('situacion_habitacional.edit')->with('situacionHabitacional', $situacionHabitacional);
    }

    /**
     * Update the specified SituacionHabitacional in storage.
     *
     * @param  int              $id
     * @param UpdateSituacionHabitacionalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSituacionHabitacionalRequest $request)
    {
        $situacionHabitacional = $this->situacionHabitacionalRepository->findWithoutFail($id);

        if (empty($situacionHabitacional)) {
            Flash::error('Situacion Habitacional not found');

            return redirect(route('admin.situacionHabitacional.index'));
        }

        $situacionHabitacional = $this->situacionHabitacionalRepository->update($request->all(), $id);

        Flash::success('Situacion Habitacional updated successfully.');

        return redirect(route('admin.situacionHabitacional.index'));
    }

    /**
     * Remove the specified SituacionHabitacional from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $situacionHabitacional = $this->situacionHabitacionalRepository->findWithoutFail($id);

        if (empty($situacionHabitacional)) {
            Flash::error('Situacion Habitacional not found');

            return redirect(route('admin.situacionHabitacional.index'));
        }

        $this->situacionHabitacionalRepository->delete($id);

        Flash::success('Situacion Habitacional deleted successfully.');

        return redirect(route('admin.situacionHabitacional.index'));
    }
}
