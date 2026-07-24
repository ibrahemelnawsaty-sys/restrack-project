{{--
    Restrack — Certificate of Completion (A4 LANDSCAPE) for barryvdh/laravel-dompdf.

    DOMPDF NOTES (read before editing):
    - dompdf is NOT a browser: no flexbox, no grid, no CSS custom properties,
      no backdrop-filter. Layout here uses tables, absolute positioning,
      inline-block and inline styles only.
    - Font is 'DejaVu Sans' (dompdf's bundled Unicode face) so Arabic glyphs at
      least render. HOWEVER dompdf does NOT shape/join Arabic letters correctly
      (letters appear disconnected / reversed). Therefore ENGLISH is the primary
      certificate text and Arabic is a secondary line only. For production-grade
      Arabic shaping, switch the PDF engine to mpdf later (mpdf handles RTL
      joining natively). Do not rely on this file for correct Arabic typography.

    Variables passed in by CertificateService::generatePdf():
      $certificate, $studentName, $levelTitle, $score,
      $certificateNumber, $issuedAt, $type ('level'|'final')
--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }

        html, body {
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', sans-serif;
            color: #16264b;
            /* A4 landscape @ 96dpi ~ 1122 x 793pt; dompdf sizes by @page. */
        }

        /* Full-bleed outer band = the outer gold frame colour. */
        .sheet {
            position: relative;
            width: 100%;
            height: 793px;
            background-color: #ffffff;
        }

        /* Outer gold border */
        .frame-outer {
            position: absolute;
            top: 18px; left: 18px; right: 18px; bottom: 18px;
            border: 6px solid #af9136;
        }

        /* Thin navy separator */
        .frame-mid {
            position: absolute;
            top: 27px; left: 27px; right: 27px; bottom: 27px;
            border: 1px solid #16264b;
        }

        /* Inner gold hairline — the double-border look */
        .frame-inner {
            position: absolute;
            top: 33px; left: 33px; right: 33px; bottom: 33px;
            border: 2px solid #af9136;
        }

        /* Content sits inside the innermost frame */
        .content {
            position: absolute;
            top: 55px; left: 70px; right: 70px; bottom: 55px;
            text-align: center;
        }

        .wordmark {
            font-size: 34px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #16264b;
            margin: 0;
        }
        .wordmark .dot { color: #af9136; }

        .org-ar {
            font-size: 13px;
            color: #af9136;
            margin: 2px 0 0 0;
            letter-spacing: 1px;
        }

        .rule {
            width: 120px;
            border: 0;
            border-top: 2px solid #af9136;
            margin: 14px auto 14px auto;
        }

        .title {
            font-size: 40px;
            font-weight: bold;
            color: #16264b;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin: 6px 0 0 0;
        }
        .title-ar {
            font-size: 18px;
            color: #af9136;
            margin: 4px 0 0 0;
        }

        .presented {
            font-size: 14px;
            color: #555555;
            font-style: italic;
            margin: 22px 0 6px 0;
        }

        .student-name {
            font-size: 38px;
            font-weight: bold;
            color: #16264b;
            margin: 0 0 4px 0;
        }
        .name-underline {
            width: 420px;
            border: 0;
            border-top: 2px solid #af9136;
            margin: 6px auto 0 auto;
        }

        .completion {
            font-size: 15px;
            color: #333333;
            margin: 20px auto 0 auto;
            width: 78%;
            line-height: 1.5;
        }
        .program-name {
            font-weight: bold;
            color: #16264b;
        }
        .score {
            display: inline-block;
            margin-top: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #af9136;
        }

        .completion-ar {
            font-size: 12px;
            color: #777777;
            margin-top: 8px;
        }

        /* Footer as a table (dompdf-safe columns) */
        .footer {
            position: absolute;
            left: 70px; right: 70px; bottom: 30px;
        }
        .footer table { width: 100%; border-collapse: collapse; }
        .footer td {
            vertical-align: bottom;
            font-size: 11px;
            color: #333333;
        }
        .footer .col-left  { text-align: left;  width: 38%; }
        .footer .col-mid   { text-align: center; width: 24%; }
        .footer .col-right { text-align: right; width: 38%; }

        .foot-label { color: #af9136; font-weight: bold; }
        .foot-value { color: #16264b; }

        .sign-line {
            border-top: 1.5px solid #16264b;
            width: 180px;
            margin: 0 0 4px auto;
        }
        .sign-label {
            font-size: 11px;
            color: #16264b;
            font-weight: bold;
        }

        .verify {
            font-size: 10px;
            color: #555555;
        }
        .verify a { color: #16264b; text-decoration: none; }
        .national {
            font-size: 11px;
            color: #16264b;
            font-weight: bold;
        }

        /* Corner accents */
        .corner {
            position: absolute;
            width: 26px;
            height: 26px;
        }
        .corner-tl { top: 40px;    left: 40px;    border-top: 4px solid #16264b; border-left: 4px solid #16264b; }
        .corner-tr { top: 40px;    right: 40px;   border-top: 4px solid #16264b; border-right: 4px solid #16264b; }
        .corner-bl { bottom: 40px; left: 40px;    border-bottom: 4px solid #16264b; border-left: 4px solid #16264b; }
        .corner-br { bottom: 40px; right: 40px;   border-bottom: 4px solid #16264b; border-right: 4px solid #16264b; }

        .seal {
            display: inline-block;
            width: 64px;
            height: 64px;
            border: 3px solid #af9136;
            border-radius: 32px;
            text-align: center;
            color: #af9136;
            font-size: 9px;
            font-weight: bold;
            line-height: 1.2;
        }
        .seal span { display: inline-block; padding-top: 20px; letter-spacing: 1px; }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="frame-outer"></div>
        <div class="frame-mid"></div>
        <div class="frame-inner"></div>

        {{-- Decorative navy corner accents --}}
        <div class="corner corner-tl"></div>
        <div class="corner corner-tr"></div>
        <div class="corner corner-bl"></div>
        <div class="corner corner-br"></div>

        <div class="content">
            {{-- Brand wordmark --}}
            <p class="wordmark">RESTRACK<span class="dot">.</span></p>
            {{-- Arabic org name (secondary; dompdf shaping limited — see head comment) --}}
            <p class="org-ar" dir="rtl">مؤسسة ريستراك للتدريب</p>

            <hr class="rule">

            {{-- Certificate title (English primary) --}}
            <p class="title">Certificate of Completion</p>
            <p class="title-ar" dir="rtl">شهادة إكمال</p>

            {{-- Recipient --}}
            <p class="presented">This is proudly presented to</p>
            <p class="student-name">{{ $studentName }}</p>
            <hr class="name-underline">

            {{-- Achievement line --}}
            <p class="completion">
                for successfully completing
                @if ($type === 'final')
                    <span class="program-name">Research Track Programs (1) — From Beginner to Expert in Medical Research</span>
                @else
                    <span class="program-name">{{ $levelTitle }}</span>
                @endif
                <br>
                <span class="score">Score: {{ $score }}%</span>
            </p>
            {{-- Arabic secondary line --}}
            <p class="completion-ar" dir="rtl">
                @if ($type === 'final')
                    لإتمام برنامج المسار البحثي (1) — من المبتدئ إلى الخبير في البحث الطبي
                @else
                    لإتمام {{ $levelTitle }}
                @endif
            </p>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <table>
                <tr>
                    <td class="col-left">
                        <span class="foot-label">Certificate No.</span>
                        <span class="foot-value">{{ $certificateNumber }}</span><br>
                        <span class="foot-label">Issued</span>
                        <span class="foot-value">{{ $issuedAt }}</span><br>
                        <span class="verify">
                            Verify at:
                            <a href="{{ route('certificate.verify', $certificate->certificate_number) }}">{{ route('certificate.verify', $certificate->certificate_number) }}</a>
                        </span><br>
                        <span class="national">National Unified No. 7053567603</span>
                    </td>
                    <td class="col-mid">
                        <div class="seal"><span>RESTRACK<br>VERIFIED</span></div>
                    </td>
                    <td class="col-right">
                        <div class="sign-line"></div>
                        <span class="sign-label">Program Director</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
