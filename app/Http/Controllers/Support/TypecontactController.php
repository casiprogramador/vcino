<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateTypecontactRequest;
use App\Http\Requests\UpdateTypecontactRequest;
use App\Repositories\TypecontactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TypecontactController extends AppBaseController
{
    /** @var  TypecontactRepository */
    private $typecontactRepository;

    public function __construct(TypecontactRepository $typecontactRepo)
    {
        $this->typecontactRepository = $typecontactRepo;
    }

    /**
     * Display a listing of the Typecontact.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->typecontactRepository->pushCriteria(new RequestCriteria($request));
        $typecontacts = $this->typecontactRepository->all();

        return view('typecontacts.index')
            ->with('typecontacts', $typecontacts);
    }

    /**
     * Show the form for creating a new Typecontact.
     *
     * @return Response
     */
    public function create()
    {
        return view('typecontacts.create');
    }

    /**
     * Store a newly created Typecontact in storage.
     *
     * @param CreateTypecontactRequest $request
     *
     * @return Response
     */
    public function store(CreateTypecontactRequest $request)
    {
        $input = $request->all();

        $typecontact = $this->typecontactRepository->create($input);

        Flash::success('Typecontact saved successfully.');

        return redirect(route('admin.typecontacts.index'));
    }

    /**
     * Display the specified Typecontact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $typecontact = $this->typecontactRepository->findWithoutFail($id);

        if (empty($typecontact)) {
            Flash::error('Typecontact not found');

            return redirect(route('admin.typecontacts.index'));
        }

        return view('typecontacts.show')->with('typecontact', $typecontact);
    }

    /**
     * Show the form for editing the specified Typecontact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $typecontact = $this->typecontactRepository->findWithoutFail($id);

        if (empty($typecontact)) {
            Flash::error('Typecontact not found');

            return redirect(route('admin.typecontacts.index'));
        }

        return view('typecontacts.edit')->with('typecontact', $typecontact);
    }

    /**
     * Update the specified Typecontact in storage.
     *
     * @param  int              $id
     * @param UpdateTypecontactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypecontactRequest $request)
    {
        $typecontact = $this->typecontactRepository->findWithoutFail($id);

        if (empty($typecontact)) {
            Flash::error('Typecontact not found');

            return redirect(route('admin.typecontacts.index'));
        }

        $typecontact = $this->typecontactRepository->update($request->all(), $id);

        Flash::success('Typecontact updated successfully.');

        return redirect(route('admin.typecontacts.index'));
    }

    /**
     * Remove the specified Typecontact from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $typecontact = $this->typecontactRepository->findWithoutFail($id);

        if (empty($typecontact)) {
            Flash::error('Typecontact not found');

            return redirect(route('admin.typecontacts.index'));
        }

        $this->typecontactRepository->delete($id);

        Flash::success('Typecontact deleted successfully.');

        return redirect(route('admin.typecontacts.index'));
    }
}
