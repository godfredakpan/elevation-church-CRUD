<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Rules\EmailValidation;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        if (!filter_var($request->email_address, FILTER_VALIDATE_EMAIL)) {
            return response()->json("$request->email_address is not a valid email address");
        }
            try {
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email_address = $request->email_address;
                $user->phone_number = $request->phone_number;
                $user->profile_picture = $this->uploadFile($request->profile_picture);
                $user->residential_address = $request->residential_address;
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json($user);
            } catch (\Throwable $th) {
                throw $th;
            }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return response()->json('user Not found');
        }

        try {
            $data = array();

            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['email_address'] = $request->email_address;
            $data['phone_number'] = $request->phone_number;
            $data['residential_address'] = $request->residential_address;

            $user = User::where('id', $id)->update($data);

            return response()->json([
                'user' => $data,
                'message' => 'user updated successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json('Error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return response()->json('user Not found');
        }

        try {
            User::where('id', $id)->delete();
            return response()->json('user deleted');
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function uploadFile($file)
    {
        if(!request()->allFiles()){
            return '';
        }
        if ($file) {

            $date_time =  date('Y-m-d H:i:s');

            $dateTime_str =  str_replace(" ", "", str_replace(":", "", $date_time));

            $fileName = preg_replace('/\s+/', '', $file->getClientOriginalName());

            $url = '/profile_pictures' . '/' . $dateTime_str . $fileName;

            $file_name = $url;

            $name = $dateTime_str . $fileName;

            $file->move("profile_pictures/" . "/", $file_name);

            $document_link  = '/profile_pictures/' . $name;

            return $document_link;
        }

        return null;
    }
}
