<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Packages\FileManager\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        // storage/app/
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $fileManager = new FileManager($storagePath);
        $resp = [
            'data' => []
        ];
        foreach ($fileManager->list() as $file) {
            $resp['data'][] = $file;
        }

        return response()->json($resp, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        $fileManager = new FileManager($storagePath);
        return $fileManager->view($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
