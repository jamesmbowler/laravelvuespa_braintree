<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionsRequest;
use App\Http\Requests\UpdateSubscriptionsRequest;
use App\Models\Subscriptions;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionsRequest  $request
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionsRequest $request, Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriptions $subscriptions)
    {
        //
    }
}
