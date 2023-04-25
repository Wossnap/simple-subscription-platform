<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Website $website, User $user)
    {
        if (Subscription::where('user_id', $user->id)->where('website_id', $website->id)->exists()) {
            return response()->json(['message' => 'Already subscribed'], 400);
        }

        $user->subscriptions()->attach($website);

        return response()->json(['message' => 'Subscription Successful']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
