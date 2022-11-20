<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\FriendRequestMail;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FriendRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $getInivited = $request->get('email_username');
        $getInvitedUser = User::where('user_name', $getInivited)->orWhere('email', $getInivited)->first();
        $getLoginSender = Auth::user()->name;
        $getTournament = $request->get('tournament_id');
        $getTournamentDetails = Tournament::where('id', $getTournament)->first();
        $mailData = [
            'title' => 'Friend Request from ' . $getLoginSender . ' to ' . $getInvitedUser->name,
            'body' => 'Hi dear, please click the invitation below to play the ' . $getTournamentDetails->name . ' at ' . $getTournamentDetails->venue
        ];
        // $email = $request->;
        $email = $getInvitedUser->email;
        Mail::to($email)->send(new FriendRequestMail($mailData));

        return response()->json([
            'status' => 200,
            'message' => 'Friend Request sent successfully' . $getInvitedUser->name
        ]);
    }
}
