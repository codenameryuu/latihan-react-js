<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        $status = true;
        $message = 'Data berhasil diambil !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = [
            'username' => 'required|unique:users,username',
            'password' => 'required:confirmed',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'whatsapp_phone' => 'required|unique:users,whatsapp_phone',
        ];

        $request->validate($validateData);

        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_phone' => $request->whatsapp_phone,
        ];

        $id = User::create($data)->id;
        $data = User::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validateData = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
        ];

        if ($request->email != $user->email) {
            $validateData['email'] = 'required|email|unique:users,email';
        }

        if ($request->whatsapp_phone != $user->whatsapp_phone) {
            $validateData['whatsapp_phone'] = 'required|unique:users,whatsapp_phone';
        }

        $request->validate($validateData);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_phone' => $request->whatsapp_phone,
        ];

        if ($request->email) {
            $data['email'] = $request->email;
        }

        if ($request->whatsapp_phone) {
            $data['whatsapp_phone'] = $request->whatsapp_phone;
        }

        User::find($user->id)->update($data);
        $data = User::firstWhere('id', $user->id);

        $status = true;
        $message = 'Data berhasil diubah !';

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $validateData = [
            'user_id' => 'required|exist:users,id',
        ];

        $request->validate($validateData);

        User::find($request->user_id)->delete();

        $status = true;
        $message = 'Data berhasil dihapus !';

        $response = [
            'status' => $status,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
