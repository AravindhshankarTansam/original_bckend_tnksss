<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMail(Request $request)
    {
        // ✅ Validate user input
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            // ✅ Prepare plain-text message
            $body = "You have a new contact form submission:\n\n"
                  . "Name: {$data['name']}\n"
                  . "Email: {$data['email']}\n"
                  . "Message:\n{$data['message']}";

            // ✅ Send mail
            Mail::raw($body, function ($msg) use ($data) {
                $msg->to("tnksss2014@gmail.com") // your inbox
                    ->from("tnksss2014@gmail.com", "TNKSSS Website") // must be your verified Gmail
                    ->replyTo($data['email'], $data['name']) // user’s email so reply works
                    ->subject("📩 New Contact Form Submission");
            });

            // ✅ Success response
            return response()->json([
                'success' => true,
                'message' => 'Mail sent successfully!',
            ]);

        } catch (\Exception $e) {
            // ❌ Error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to send mail: ' . $e->getMessage(),
            ], 500);
        }
    }
}
