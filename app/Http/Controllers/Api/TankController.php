<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTankRequest;
use App\Http\Requests\UpdateTankRequest;
use App\Services\TankService;
use Illuminate\Http\Request;

class TankController extends Controller
{

    public function __construct(
        protected TankService $tankService
    ) {}


  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success'=> true,
            'data' => $this->tankService->paginateTanks()
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTankRequest $request)
    {
        $tank = $this->tankService->createTank($request->validated());

        return response()->json(
            [
                'success'=> true,
                'message' => 'Tank created successfully',
                'data' => $tank
            ], 201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response () ->json([
            'success'=> true,
            'data'=>$this->tankService->findTank($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTankRequest $request, int $id)
    {
        $tank = $this->tankService->updateTank($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tank updated successfull',
            'data' => $tank
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->tankService->delete($id);

        return response ()->json([
            'success' => true,
            'message' => 'Tank deleted succescfully'
        ]);
    }
}
