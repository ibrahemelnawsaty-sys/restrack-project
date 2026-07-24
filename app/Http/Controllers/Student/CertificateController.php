<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::where('user_id', auth()->id())
            ->with('level')
            ->orderByDesc('issued_at')
            ->get();

        return view('student.certificates', compact('certificates'));
    }

    public function download(Certificate $certificate, CertificateService $certificateService)
    {
        if ($certificate->user_id !== auth()->id()) {
            abort(403);
        }

        $pdf = $certificateService->generatePdf($certificate);

        return $pdf->download("certificate-{$certificate->certificate_number}.pdf");
    }
}
