<?php

namespace App\Http\Controllers;

use App\Jobs\FriendRequestJob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\FriendRequestMail;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(Request $request)
    {
        FriendRequestJob::dispatch();
        return response()->json([
            'status' => 200,
            'message' => 'Friend Request sent successfully'
        ]);

        // $getInivited = $request->get('email_username');
        // $getInvitedUser = User::where('user_name', $getInivited)->orWhere('email', $getInivited)->first();
        // $getLoginSender = Auth::user()->name;
        // $getTournament = $request->get('tournament_id');
        // $getTournamentDetails = Tournament::where('id', $getTournament)->first();
        // $mailData = [
        //     'title' => 'Friend Request from ' . $getLoginSender . ' to ' . $getInvitedUser->name,
        //     'body' => 'Hi dear, please click the invitation below to play the ' . $getTournamentDetails->name . ' at ' . $getTournamentDetails->venue
        // ];
        // // $email = $request->;
        // $email = $getInvitedUser->email;
        // Mail::to($email)->send(new FriendRequestMail($mailData));

        // return response()->json([
        //     'status' => 200,
        //     'message' => 'Friend Request sent successfully' . $getInvitedUser->name
        // ]);
    }
}
