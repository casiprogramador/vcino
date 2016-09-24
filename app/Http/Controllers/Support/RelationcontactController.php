<?php

namespace App\Http\Controllers\Support;

use App\Http\Requests\CreateRelationcontactRequest;
use App\Http\Requests\UpdateRelationcontactRequest;
use App\Repositories\RelationcontactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RelationcontactController extends AppBaseController
{
    /** @var  RelationcontactRepository */
    private $relationcontactRepository;

    public function __construct(RelationcontactRepository $relationcontactRepo)
    {
        $this->relationcontactRepository = $relationcontactRepo;
    }

    /**
     * Display a listing of the Relationcontact.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->relationcontactRepository->pushCriteria(new RequestCriteria($request));
        $relationcontacts = $this->relationcontactRepository->all();

        return view('relationcontacts.index')
            ->with('relationcontacts', $relationcontacts);
    }

    /**
     * Show the form for creating a new Relationcontact.
     *
     * @return Response
     */
    public function create()
    {
        return view('relationcontacts.create');
    }

    /**
     * Store a newly created Relationcontact in storage.
     *
     * @param CreateRelationcontactRequest $request
     *
     * @return Response
     */
    public function store(CreateRelationcontactRequest $request)
    {
        $input = $request->all();

        $relationcontact = $this->relationcontactRepository->create($input);

        Flash::success('Relationcontact saved successfully.');

        return redirect(route('admin.relationcontacts.index'));
    }

    /**
     * Display the specified Relationcontact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $relationcontact = $this->relationcontactRepository->findWithoutFail($id);

        if (empty($relationcontact)) {
            Flash::error('Relationcontact not found');

            return redirect(route('admin.relationcontacts.index'));
        }

        return view('relationcontacts.show')->with('relationcontact', $relationcontact);
    }

    /**
     * Show the form for editing the specified Relationcontact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $relationcontact = $this->relationcontactRepository->findWithoutFail($id);

        if (empty($relationcontact)) {
            Flash::error('Relationcontact not found');

            return redirect(route('admin.relationcontacts.index'));
        }

        return view('relationcontacts.edit')->with('relationcontact', $relationcontact);
    }

    /**
     * Update the specified Relationcontact in storage.
     *
     * @param  int              $id
     * @param UpdateRelationcontactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRelationcontactRequest $request)
    {
        $relationcontact = $this->relationcontactRepository->findWithoutFail($id);

        if (empty($relationcontact)) {
            Flash::error('Relationcontact not found');

            return redirect(route('admin.relationcontacts.index'));
        }

        $relationcontact = $this->relationcontactRepository->update($request->all(), $id);

        Flash::success('Relationcontact updated successfully.');

        return redirect(route('admin.relationcontacts.index'));
    }

    /**
     * Remove the specified Relationcontact from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $relationcontact = $this->relationcontactRepository->findWithoutFail($id);

        if (empty($relationcontact)) {
            Flash::error('Relationcontact not found');

            return redirect(route('admin.relationcontacts.index'));
        }

        $this->relationcontactRepository->delete($id);

        Flash::success('Relationcontact deleted successfully.');

        return redirect(route('admin.relationcontacts.index'));
    }
}
