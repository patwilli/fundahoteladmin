<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function indexClients()
    {
        $clients = User::all();
        return view('clients', compact('clients'));
    }
    public function banClient($id)
    {
        $client = User::find($id);
        if (!$client) {
            return redirect()->route('all-client')->with('error', 'Client non trouvé');
        }
        $client->update(['status' => 1]);

        return redirect()->route('all-client')->with('success', 'Statut de la chambre mis à jour avec succès');
    }
    public function unbanClient($id)
    {
        $client = User::find($id);
        if (!$client) {
            return redirect()->route('all-client')->with('error', 'Client non trouvé');
        }
        $client->update(['status' => 0]);

        return redirect()->route('all-client')->with('success', 'Statut de la chambre mis à jour avec succès');
    }
}
