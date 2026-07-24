<?php

namespace App\Services;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateService
{
    public function generatePdf(Certificate $certificate)
    {
        $certificate->load(['user', 'level']);

        $data = [
            'certificate' => $certificate,
            'studentName' => $certificate->user->name,
            'levelTitle' => $certificate->level?->title ?? __('messages.final_certificate'),
            'score' => $certificate->score,
            'certificateNumber' => $certificate->certificate_number,
            'issuedAt' => $certificate->issued_at->format('Y-m-d'),
            'type' => $certificate->type,
        ];

        $pdf = Pdf::loadView('certificates.template', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf;
    }
}
