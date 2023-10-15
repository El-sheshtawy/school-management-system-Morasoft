<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Repository\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{

    protected $fees;

    public function __construct(FeesRepositoryInterface $fees)
    {
        $this->fees=$fees;
    }

    public function index()
    {
        return $this->fees->index();
    }


    public function create()
    {
        return $this->fees->create();
    }


    public function store(FeeRequest $request)
    {
        return $this->fees->store($request);
    }


    public function edit($id)
    {
        return $this->fees->edit($id);
    }


    public function update(FeeRequest $request)
    {
        return $this->fees->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->fees->destroy($request);
    }

    public function show($id)
    {
        return $this->fees->show($id);
    }
}
