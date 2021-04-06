<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\PropertyInterface;
use App\Services\Interfaces\UserInterface;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    private $service;
    private $userService;

    public function __construct(PropertyInterface $propertyService, UserInterface $userInterface)
    {
        $this->service = $propertyService;
        $this->userService = $userInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = [
            'http_code' => 200
        ];

        try {
            $return['data'] = $this->service->getAll();
        } catch(\Exception $e) {
            $return = parent::errorMessage($e->getCode());
        }

        return response()->json($return, $return['http_code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->dataValidation($request);
        if($validation) {
            return $validation;
        }

        $return = [
            'http_code' => 201,
            'message' => 'Property saved successfully'
        ];

        try {
            $this->service->save($request->all());
        } catch(\Exception $e) {    
            $return = parent::errorMessage($e->getMessage());   
        }

        return response()->json($return, $return['http_code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = [
            'http_code' => 200
        ];

        try {
            $return['data'] = $this->service->getOne($id);
        } catch (\Exception $e) {
            $return = parent::errorMessage($e->getCode());
        }
        
        return response()->json($return, $return['http_code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $this->dataValidation($request);
        if($validation) {
            return $validation;
        }

        $return = [
            'http_code' => 200,
            'message' => 'Property updated successfully'
        ];

        try {
            $this->service->save($request->all(), $id);
        } catch(\Exception $e) {    
            $return = parent::errorMessage($e->getCode());   
        }

        return response()->json($return, $return['http_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = [
            'http_code' => 204
        ];

        try {
            $this->service->delete($id);
        } catch (\Exception $e) {
            $return = parent::errorMessage($e->getCode());   
        }

        return response()->json([], $return['http_code']);
    }

    /**
     * Validation for data passed
     * 
     * @param Request $request
     * @return bool
     */
    public function dataValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'total_area' => 'required',
            'value' => 'required',
            'discount' => 'required',
            'owner_id' => 'required|exists:App\Models\User,id'
        ]);

        if($validator->fails()) {
            $return = [
                'http_code' => 400,
                'data' => $validator->errors()
            ];

            return response()->json($return, $return['http_code']);
        }

        return false;
    }
}
