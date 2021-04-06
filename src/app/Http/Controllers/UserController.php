<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\UserInterface;

class UserController extends Controller
{
    private $service;

    public function __construct(UserInterface $userService)
    {
        $this->service = $userService;
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
        $return = [
            'http_code' => 201,
            'message' => 'User saved successfully'
        ];

        try {
            $this->service->save($request->all());
        } catch(\Exception $e) {    
            $return = parent::errorMessage($e->getCode());   
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
        $return = [
            'http_code' => 200,
            'message' => 'User updated successfully'
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
}
