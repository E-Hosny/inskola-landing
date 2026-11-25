<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|email',
        ]);

        try {
            Mail::raw(
                'Inskola Mailgun test email — if you received this, mail is working.',
                function ($message) use ($validated) {
                    $message
                        ->to($validated['to'])
                        ->subject('Inskola — Mailgun test');
                }
            );

            return response()->json([
                'ok' => true,
                'message' => 'Test email sent successfully.',
                'to' => $validated['to'],
                'mailer' => config('mail.default'),
                'from' => config('mail.from'),
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'ok' => false,
                'message' => 'Failed to send test email.',
                'error' => $e->getMessage(),
                'mailer' => config('mail.default'),
            ], 500);
        }
    }
}
