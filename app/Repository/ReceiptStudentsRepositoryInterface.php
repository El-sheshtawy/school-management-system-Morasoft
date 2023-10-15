<?php


namespace App\Repository;


use Illuminate\Http\Request;

interface ReceiptStudentsRepositoryInterface
{
    public function index();

    public function show($id);

    public function edit($id);

    public function store(Request $request);

    public function update(Request $request);

    public function destroy(Request $request);
}
