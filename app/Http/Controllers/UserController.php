<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(string $handle)
    {
        $user = User::firstWhere('handle', $handle);

        return response()->json([
            '@context' => [
                'https://w3id.org/security/v1',
                'https://www.w3.org/ns/activitystreams'
            ],
            'id' => request()->url(),
            "type" => "Person",
            "publicKey" => [
                "id" => "http://mammut.test/users/$user->handle#main-key",
                "owner" => "http://mammut.test/users/$user->handle",
                "publicKeyPem" => $user->publicKey,
            ]
        ]);
    }
}