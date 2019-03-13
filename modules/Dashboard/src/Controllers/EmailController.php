<?php
namespace Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Dashboard\Requests\EmailRequest;
use Dashboard\Services\EmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    /**
     * @var EmailService
     */
    public $emailService;

    /**
     * EmailService constructor.
     *
     * @param EmailService $emailService
     */
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    /**
     * Send mail.
     * @param EmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function sendAction(EmailRequest $request)
    {
        $this->emailService->save($request->all());
        $agreement = $request->get('agreement') ? 'confirmed' : 'unconfirmed';

        Mail::send('dashboard::partial.email',
            array(
                'subject' => $request->get('subject'),
                'email' => Auth::user()->email,
                'content' => $request->get('content'),
                'date' => $request->get('date'),
                'agreement' => $agreement
            ), function($message)
            {
                $message->from('deoling.email.sender@gmail.com');
                $message->to('kacperx95@gmail.com', 'Test')->subject('Mail from app');
            });

        return back()->with('success', 'Thanks for send email!');
    }
}
