<?php

namespace App\Http\Controllers;

use App\Models\Certificate;

class CertificateVerificationController extends Controller
{
    public function verify(string $number)
    {
        $certificate = Certificate::where('certificate_number', $number)->first();

        if ($certificate) {
            $certificate->increment('verified_count');
        }

        return view('pages.verify-certificate', compact('certificate'));
    }
}
