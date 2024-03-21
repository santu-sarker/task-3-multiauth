<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        $unapproved_users = User::where('is_verified', 0)
            ->get();
        return view("admin_home")
            ->with(['users' => $unapproved_users]);
    }

    public function approve_user(Request $req, $id)
    {
        if ($req->ajax()) {
            try {
                $user = User::where('id', $id)->first();

                if ($user) {

                    $user->update(['is_verified' => 1]);

                    return response()->json(['type' => 'success', 'msg' => 'User Request has been approved!']);
                }
                return response()->json(['type' => 'failed', 'msg' => 'User not found!']);
            } catch (Exception $e) {
                return response()->json(['type' => 'failed', 'msg' => "An Error Occured!"]);
            }
        } else {
            abort(403, "action not allowed");
        }
    }
    public function decline_user(Request $req, $id)
    {
        if ($req->ajax()) {
            try {
                $user = User::where('id', $id)->first();

                if ($user) {
                    $user->delete();

                    return response()->json(['type' => 'success', 'msg' => 'User Request has been declined!']);
                }
                return response()->json(['type' => 'failed', 'msg' => 'User not found!']);
            } catch (Exception $e) {
                return response()->json(['type' => 'failed', 'msg' => "An Error Occured!"]);
            }
        } else {
            abort(403, "action not allowed");
        }
    }
}
