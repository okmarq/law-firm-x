<?php

namespace App\Http\Controllers;

use App\Events\ClientCreated;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ClientResource::collection(Client::all());
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
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->all());

        ClientCreated::dispatch($client);

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function showByLastName(Request $request)
    {
        $last_name = $request->last_name;
        $clients = Client::query();
        if ($last_name) {
            $clients->where('last_name', 'LIKE', '%' . $last_name . '%');
        }
        $clients = $clients->get();
        return ClientResource::collection($clients);
    }

    public function showByTIme()
    {
        return ClientResource::collection(Client::where('profile_image', null)->orWhereDate('last_notification', '<', Carbon::now()->subDays(3))->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response(null, 204);
    }
}
