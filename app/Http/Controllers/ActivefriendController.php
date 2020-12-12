<?php

namespace App\Http\Controllers;

use App\Models\Activefriend;
use Illuminate\Http\Request;

class ActivefriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $activefriend = Activefriend::all();
        return response()->json($activefriend);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $activefriend = Activefriend::create([
            'activeFriend_id' => $request->activeFriend_id,
        ]);
        
        return response()->json($activefriend);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $leavingFriend_id = $request->leavingFriend_id;
        $leavingfriend = Activefriend::where('activeFriend_id', $leavingFriend_id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activefriend  $activefriend
     * @return \Illuminate\Http\Response
     */
    public function show(Activefriend $activefriend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activefriend  $activefriend
     * @return \Illuminate\Http\Response
     */
    public function edit(Activefriend $activefriend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activefriend  $activefriend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activefriend $activefriend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activefriend  $activefriend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activefriend $activefriend)
    {
        //
    }
}
