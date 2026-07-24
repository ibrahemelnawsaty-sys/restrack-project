<?php

namespace App\Mail;

use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateIssued extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Certificate $certificate) {}

    public function envelope(): Envelope
    {
        $subject = $this->certificate->user->locale === 'ar'
            ? 'شهادة إكمالك من ريستراك'
            : 'Your Restrack Certificate of Completion';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.certificate-issued',
            with: [
                'certificate' => $this->certificate,
                'studentName' => $this->certificate->user->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(
                fn () => app(CertificateService::class)->generatePdf($this->certificate)->output(),
                'certificate-'.$this->certificate->certificate_number.'.pdf',
            )->withMime('application/pdf'),
        ];
    }
}
