<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming contact form request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $formData = $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);
        
        // try {
        //     Mail::to('erica@schmollthoughts.com')->send(new ContactFormSubmitted($formData));
        // } catch (\Exception $e) {
        //     // Log the error
        //     Log::error('Failed to send contact form email.', [
        //         'error' => $e->getMessage(),
        //         'formData' => $formData,
        //     ]);

        //     // Optionally, redirect back with an error message
        //     return back()->with('error', 'There was a problem sending your message. Please try again later.');
        // }

        Mail::to('erica@storiesofmirrors.com')->send(new ContactFormSubmitted($formData));

        // Redirect back with a success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}