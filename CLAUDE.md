# CLAUDE.md — Restrack Constitution / دستور مشروع ريستراك

> This file is loaded automatically at the start of every session. It is the **binding contract**
> between the human owner and any AI agent working on this codebase. Read it fully before editing anything.

---

## ⚡ ملخص عربي (اقرأه أولاً)

هذا المشروع منصة تعليمية طبية (Laravel 12) وسيعمل عليها **طلاب كثيرون**، لذلك القاعدة الأولى: **لا تكسر شيئاً**.

القواعد الصارمة باختصار:

1. **الصرامة في الصواب، والسرعة في الطريقة.** كن سريعاً ومبدعاً في *كيف* تحل المشكلة، لكن كن صارماً 100% في ألا تُدخل خطأً أو تُفسد ميزة قائمة.
2. **بعد كل تعديل منطقي، شغّل بوابة التحقق إلزامياً** عبر الوكيل `regression-verifier` (`.claude/agents/regression-verifier.md`). لا تعتبر المهمة منتهية قبل أن يعطي الوكيل حكم **PASS**.
3. **التزم بأنماط المشروع الموجودة، لا تخترع أنماطاً جديدة** (نفس أسلوب الخدمات، التحقق، الترجمة العربية/الإنجليزية `_ar`/`_en`، ألوان الهوية).
4. **ملف `.env` هو إنتاج حقيقي** — لا تشغّل `php artisan migrate` بدون `--env=testing`، ولا تطبع الأسرار، ولا تعدّل `.env`.
5. **حماية المحتوى**: كن صادقاً — لا يمكن منع تصوير الشاشة داخل المتصفح تقنياً. نحمي المحتوى بطبقات واقعية (بث موقّع + علامة مائية) لا بوعود مستحيلة.
6. **الأداء أولوية**: خفيف وسريع. أعد استخدام الموجود، قلّل الاستعلامات، لا تُثقل الصفحة.

عند أي شك في نطاق تغيير كبير (هجرة قاعدة بيانات، دفع، صلاحيات، حذف) — **اسأل المالك قبل التنفيذ**.

---

## 0. Project identity

- **Product:** Restrack / مؤسسة ريستراك للتدريب — "Research Track Platform".
- **Domain:** Bilingual (ar primary, en secondary) medical-research e-learning platform.
- **National unified number:** 7053567603.
- **Brand:** Navy `#16264b` + Gold `#af9136`. Gold is the primary accent; navy is the dark base.
- **Program:** *Research Track Programs (1) — From Beginner to Expert in Medical Research* (3 levels — see `restrack-project/plan/ROADMAP.md`).
- **Audience scale:** many concurrent students → **light, fast, cache-first** is a hard requirement, not a nice-to-have.

The full, current work order (all requested modifications, the level table, copy strings) lives in **[`restrack-project/plan/ROADMAP.md`](restrack-project/plan/ROADMAP.md)** — treat it as the source of truth for *what* to build. This file governs *how* to build. **All new-project docs, design mockups, and assets live under [`restrack-project/`](restrack-project/).**

---

## 1. The stack — how it is actually wired (facts, not assumptions)

| Area | Reality |
|---|---|
| Framework | Laravel **12**, PHP **^8.2**. No `app/Console/Kernel.php` / `Http/Kernel.php` — middleware & bootstrapping live in **`bootstrap/app.php`**. |
| Auth | Hand-rolled controllers (`app/Http/Controllers/Auth/*`). **No Breeze/Fortify/Jetstream.** Single `web` guard. |
| Roles | **spatie/laravel-permission**. Seeded roles: `super_admin`, `admin`, `student` **only** (no `teacher` yet). Granular permissions are seeded but **not enforced** anywhere. |
| Frontend | **Tailwind CSS v4 (CSS-first)** — theme tokens in `@theme{}` inside `resources/css/app.css`. **There is NO `tailwind.config.js`.** Build = Vite 8 + `@vite`. |
| i18n | `__('general.*')`, `__('messages.*')`, `__('auth.*')` from `lang/{ar,en}/*.php`. Bilingual **content** uses paired `*_ar`/`*_en` DB columns + `get<Field>Attribute()` locale accessors. |
| CMS | Home/checkout page copy is partly DB-driven via `PageSection` (admin-editable), partly lang-file. |
| PDF | `barryvdh/laravel-dompdf` for certificates. |
| Payments | **Moyasar** gateway — currently a **stub** (only 100%-off free checkout works end-to-end). |
| Tests | **Pest 3** (closure style). `RefreshDatabase` is **commented out** in `tests/Pest.php`. Only `UserFactory` exists. Coverage ≈ 0. |
| Lint | **Laravel Pint**, default `laravel` preset (no `pint.json`). |
| DB (dev/test) | Tests use in-memory SQLite via `phpunit.xml` overrides. **`.env` points at a real production MySQL.** |

### ⚠️ Environment blockers you must handle before verifying
- **Dev tooling is NOT installed** — `vendor/` was built `--no-dev`, so `pest`, `phpunit`, `pint`, `faker` are missing. Run **`composer install`** once before any test/lint command works.
- **`php` may not be on PATH** in the shell. Locate/activate the PHP 8.2+ CLI first (project runs on a Hostinger/XAMPP-style stack). If PHP genuinely cannot be run, the verifier falls back to **static** checks and must say so explicitly.

---

## 2. THE PRIME DIRECTIVES (non-negotiable)

1. **Never break a working feature.** Every change is guilty of regression until proven innocent by the verification gate (§4).
2. **Strict on correctness, fast on method.** Ship the smallest correct diff that fully solves the task. Speed and creativity apply to *how* you design the solution and UX — never to skipping verification or cutting correctness.
3. **Match existing conventions; do not invent new ones** (§5). Consistency beats personal preference. If a better pattern is warranted, propose it to the owner first — don't unilaterally introduce it.
4. **Change only what the task requires.** No opportunistic refactors, renames, reformatting of untouched code, or dependency bumps bundled into a feature change.
5. **Bilingual or it's broken.** Any new user-facing text ships with **both** `_ar` and `_en` (DB) or keys in **both** `lang/ar` and `lang/en`. A missing key renders the raw dotted key on the page — that is a visible bug.
6. **Respect the money/access boundary.** Anything touching payments, subscriptions, roles, or content-access gating is high-risk — plan it explicitly, verify it hardest, and never weaken an access check to make a feature "work."
7. **Tell the truth about limits.** Especially content protection (§7): recommend what actually works; refuse to promise the impossible.
8. **When uncertain about scope or an irreversible action, ask.** DB migrations that drop/rename columns, deletions, secret changes, and destructive commands require explicit owner confirmation.

---

## 3. Mandatory workflow for EVERY change

```
PLAN  →  BUILD  →  VERIFY (gate)  →  REPORT
```

1. **PLAN** — Restate the task in one line. Identify every file/layer it touches (model, migration, controller, service, view, lang, routes). Check §6 landmines for anything nearby. For a non-trivial feature, write a short TodoWrite list.
2. **BUILD** — Implement with the smallest correct diff, following §5. Reuse existing services/scopes/utility classes instead of re-inventing.
3. **VERIFY** — Run the **Verification Gate** (§4). This is **not optional** and **not** something you self-attest — it is delegated to the `regression-verifier` agent.
4. **REPORT** — State plainly: what changed, what the verifier returned (PASS/FAIL + evidence), what you could NOT verify (e.g. tests couldn't run because PHP was unavailable), and any follow-ups. Never claim "done and tested" if the gate didn't actually run.

**Speed rule:** for a genuinely trivial edit (a lang string, a copy tweak, a CSS token) you may run the *fast lane* of the gate (§4) instead of the full suite — but the verifier is still invoked. There is no path that skips verification entirely.

### Definition of Done (a change is "done" only when ALL hold)
1. It fully does what was asked — no partial/TODO stubs left silently.
2. The verification gate (§4) returned **PASS** (or PASS-WITH-CAVEATS with the caveats reported to the owner).
3. Bilingual complete (ar + en), RTL correct, brand tokens used.
4. No §6 landmine tripped; no auth/ownership/subscription check weakened.
5. No regression to an existing feature the change touched or sits near.
6. Performance budget (§8) respected — no new N+1, blocking asset, or uncached hot query.
7. The report states plainly what changed, what was verified, and what was NOT (and why).

---

## 4. The Verification Gate — the "strict agent"

> The owner requires that **an agent always strictly verifies** that no errors were introduced and that the new change did not break anything else. That agent is
> **[`.claude/agents/regression-verifier.md`](.claude/agents/regression-verifier.md)**. Invoke it after every logical change, before reporting done.

Delegate verification with the `Agent` tool (`subagent_type: regression-verifier`), handing it: the task description, the exact list of changed files, and which features are nearby-at-risk. (The agent registry loads at session start, so in the *same* session where this file was just created, `regression-verifier` may not be selectable yet — in that one case, spawn a `general-purpose` agent told to read and follow `.claude/agents/regression-verifier.md` verbatim. New sessions get it automatically.) It runs, in order:

**Fast lane (always):**
- **Syntax:** `php -l` on each changed `.php` file (or static parse if PHP is unavailable — and it must say which).
- **Style:** `vendor/bin/pint --test --dirty`.
- **Reference integrity:** every `route('...')`, `view('...')`, `__('...')`, and Blade `@include` introduced actually resolves. New lang keys exist in **both** locales.
- **Bilingual/scope check:** new content fields have `_ar` **and** `_en`; new student queries are scoped to `auth()->id()` or guarded by `abort(403)`.

**Full lane (any logic/DB/route/payment/auth change — additionally):**
- **Tests:** `composer test` (and, if the change is testable and untested, the verifier flags that a test should be added).
- **Regression scan** of the specific §6 landmines the change is adjacent to.
- **Migration safety:** reversible `down()`, no destructive op on production data, run only against the test DB.
- **Cache note:** if Blade/lang/config changed, remind to `php artisan view:clear` (compiled views are cached and can hide edits).

**Verdict contract:** the verifier returns **PASS** only with evidence; otherwise **FAIL** with the exact failing check and the minimal fix. It **defaults to FAIL/❗when it cannot verify** something rather than assuming success. If it returns FAIL, fix and re-run the gate — do not report the task done.

---

## 5. Coding conventions — match these exactly

- **Bilingual content:** new text columns are `field_ar` + `field_en`; add a `get<Field>Attribute()` accessor returning the value for `app()->getLocale()`; views reference `$model->field` (never `$model->field_ar`).
- **Casts:** use the Laravel 12 **`protected function casts(): array`** method, never a `$casts` property. Arrays→`'array'`, money→`'decimal:2'`, flags→`'boolean'`, dates→`'datetime'`.
- **Ordering:** integer `order`/`display_order` column + a `scopeOrdered()`; chain scopes (`Level::published()->ordered()->get()`).
- **Mass assignment:** `$fillable` (never `$guarded`); persist via `->create($validated)` / `->update($validated)`. Normalize checkboxes with `$request->boolean('field')` **after** validate, then merge.
- **Validation:** inline `$request->validate([...])` with array-of-rules syntax. **No FormRequest classes** (don't introduce them unless the owner approves the new convention). Keep `store()`/`update()` rule arrays in sync.
- **Business logic:** multi-step/reusable logic → a **stateless Service** in `app/Services`, **method-injected** into the action (`function download(Certificate $c, CertificateService $s)`). Simple CRUD stays inline in the controller.
- **Controller returns:** views via `view('dotted.name', compact(...))`; mutations via `redirect()->route('admin.x.index')->with('success'|'error'|'info', __('messages.key'))`; AJAX via `response()->json([...])`. Every user-facing string goes through `__()`.
- **Routing:** admin group `['auth','admin']` + `prefix('admin')` + `name('admin.')`; student group `['auth','subscribed']` + `prefix('student')` + `name('student.')`. Register middleware aliases in `bootstrap/app.php`.
- **Authorization:** there are **no Policies/Gates**. Every student-facing query MUST be scoped (`->where('user_id', auth()->id())`) or ownership-checked (`abort(403)`). Don't assume a guard exists — add it.
- **Frontend/brand:** reuse the hand-authored utility classes in `resources/css/app.css` (`glass`, `gradient-gold`, `text-gradient-gold`, `card-lift`, `section-title`, `input-elegant`, `reveal`, …). Gold is exactly **`#af9136`** (`text-gold`/`bg-gold`); never introduce a new hex. New theme tokens go in the `@theme{}` block, not a JS config.
- **RTL:** use logical properties (`ps-`/`pe-`, `start-`/`end-`, `text-start`) and `rtl:` variants — one stylesheet serves both directions.
- **Audit:** use `ActivityLog::log($action, $description, $model, $props)` for security-relevant actions (auth, subscription, role changes).
- **Style/format:** 4-space indent, LF, UTF-8, trailing newline; let Pint (`laravel` preset) be the arbiter.

### 5.1 Expanded-scope rules (from the Master Plan — apply to all new work)
- **Roles/least-privilege:** roles are `super_admin` · `admin` · `instructor` (being added) · `student`. Every new resource gets a **deny-by-default Policy/Gate**. Instructors are scoped to **their own** content; privilege actions (role assignment, publish-approval, refunds, global config) are admin/super_admin only and **audit-logged** (`ActivityLog::log`). One active, non-expired subscription unlocks **all** content platform-wide.
- **Themes (مود ليلي/نهاري):** every UI must work in **both light and dark**, driven by CSS custom properties in the `@theme` block — never hard-code a hex that only works in one theme. Dark is the default; gold-as-text darkens to `#8A7028` on light (contrast). Test both.
- **SEO-by-default:** every new **public** page ships automatically with `hreflang` (ar/en/x-default), localized `<title>`/meta, canonical, and the relevant **JSON-LD** (Course/BreadcrumbList/FAQPage/VideoObject/Organization) via `SeoService`/`SeoMeta`. A page with no schema/meta is incomplete. (Master Plan §13.)
- **Bilingual parity:** AR and EN are first-class; ship both, RTL-correct, with logical CSS. Arabic is the default experience.
- **Security & compliance posture:** build to OWASP ASVS L2 / Top-10:2025 and align to NCA ECC; respect **PDPL** (consent, data-subject rights, sensitive health/ID data, 72h breach). Never weaken an access check; keep card data out of the app (tokenized/hosted checkout, SAQ-A); ZATCA 15% VAT invoice on every sale. (Master Plan §8–§9.)
- **Video protection:** self-hosted encrypted HLS + short-TTL signed URLs + authenticated key + web-server offload + per-student watermark; be honest that screen-capture can't be fully blocked in-browser. (Master Plan §7, this file §7.)
- **Performance is a feature:** cache hot paths, no video through PHP, self-host assets, mobile-first PWA, green Core Web Vitals (also an SEO signal).

---

## 6. Regression landmines — code that breaks silently (respect these)

These are real, currently-present hazards found in the codebase. If your change is near one, the verifier must check it.

1. **Missing view `certificates.template`** — `CertificateService::generatePdf()` renders it but the Blade file does **not exist**; certificate download currently throws. Certificate work must create `resources/views/certificates/template.blade.php`.
2. **Payment is a stub** — `PaymentService::createPayment()` returns `'#'`; only the free (100%-coupon) path completes. The Moyasar webhook looks up `Subscription` by `payment_id`, but nothing creates a pending subscription first. Wiring payments is net-new, end-to-end work, not a tweak.
3. **Webhook is unsigned + CSRF-inconsistent** — `/webhooks/moyasar` has no HMAC/signature check (a forged POST can grant free access) and no actual CSRF exemption in `bootstrap/app.php` despite the "no CSRF" comment. Fix both together.
4. **Two divergent subscription-activation paths** — `PaymentService::activateSubscription()` (increments coupon + writes ActivityLog) vs `Admin\SubscriptionController::activate()` (does neither). Editing one silently skips the other. Same for refund.
5. **Exam session state is global** — `ExamService::generateExam()` stores questions under the single session key `exam_questions`; two open exams/tabs clobber each other and grade against the wrong set. Grading uses strict `===` with no cast — an int/string drift silently marks answers wrong.
6. **`is_active=false` users can still log in** — no check in `LoginController`/`Auth::attempt` and no middleware. Don't assume deactivation blocks access.
7. **Nested route bindings aren't scoped** — `levels.lectures` has no `->scopeBindings()`, so a `{lecture}` from another level is accepted under any `{level}`.
8. **`custom` video provider has no player branch** and there is **no file-upload path** — self-hosted/recorded video does not actually play today. "Recorded videos" needs an upload+storage+player branch.
9. **Speakers aren't Users** — `speakers` has an `email` string but no `user_id`; there is no `teacher` role or portal. Teacher self-upload is net-new schema + role + routing.
10. **Removing "accredited/معتمد" touches many places** — several `lang/{ar,en}` keys, several blades, and a FAQ answer in `database/seeders/SampleDataSeeder.php`. Also **stale compiled Blade caches** in `storage/framework/views` still contain the old text — run `php artisan view:clear` after edits.
11. **Missing i18n keys render raw dotted keys** — many home/footer keys (e.g. `hero_highlight`, `live_now`, `about_us`, …) are absent from both lang files; because `__()` returns the key string (never null), the `?? 'fallback'` idiom does **not** save you. Add keys to **both** files.
12. **`Certificate::generateNumber()`** has no DB-uniqueness guard — collision-prone at volume.
13. **`AppServiceProvider` `View::composer('*')`** caches `SiteSetting::all()` in a process-`static` — serves stale settings under long-running workers (Octane/queue).
14. **Config/route/view caches** — if you change config, routes, or Blade and things "don't update," clear the relevant cache. In tests always `php artisan config:clear` first (this is why `composer test` does it).

---

## 7. Security & content protection — honest, layered rules

The owner's decision: **all videos are self-hosted INSIDE the platform — there are NO external YouTube/Vimeo videos.** Teachers upload lectures; the platform owns storage and delivery. The owner wants to stop students downloading videos or screen-recording. **Be honest with them.**

**Hard limits (state these plainly; never promise otherwise):**
- **Screenshots and screen-recording cannot be prevented in a browser.** Video is decoded to pixels; OS/GPU capture, capture cards, or a phone camera defeat every in-browser trick. The realistic answer to this is **traceability (watermarking)**, not prevention.
- **Disabling right-click / F12 / view-source is cosmetic.** Never treat it as a security control.
- **Any URL the browser can play, a script can fetch.** Protection = short-lived tokens + encryption + traceability, which shrink and attribute the theft window; they do not make it zero.

**Current state → target:** the code today uses external embeds (`video_provider` = `youtube`/`vimeo`, raw `video_url` in HTML) and the `custom` provider has no player and no upload path. **That external model is being replaced by fully self-hosted video.** Build the `custom`/self-hosted path; do not add new external-embed features.

**Self-hosted protection architecture (build these — the realistic layered target):**
1. **Store originals privately, never on the `public` disk.** Uploads go to `storage/app/private` or an S3-compatible object store — never a web-served path, never a guessable `/storage/...` URL.
2. **Serve only through an authenticated + entitlement-checked route with short-TTL signed access.** No direct file URL is ever rendered into the page; the player requests a per-session, expiring signed URL (e.g. `temporarySignedRoute`) that verifies the student's active subscription entitles them to that lecture's level.
3. **Prefer HLS with encrypted segments (AES-128) over one big MP4** for anything at scale: the manifest points at short segments, and the decryption key is delivered through a token-gated endpoint. This enables adaptive quality, resumable/rangeable delivery, and a far smaller theft window than a single downloadable file.
4. **Put a CDN in front of segment delivery.** **NEVER stream large video bytes through PHP-FPM/Laravel** — it will not scale to many students and will bottleneck the whole app. Laravel mints tokens and checks entitlement; the CDN/object store serves the bytes.
5. **Dynamic per-student watermarking** (name/email/session id overlaid — moving CSS/JS overlay now, burned-in server-side later) — the real deterrent for screen-recording: it makes any leak **traceable to the account that leaked it**.
6. Optionally **DRM** (Widevine/PlayReady/FairPlay) — stops automated/`yt-dlp`-class downloading; does **not** stop screen capture; adds real cost/device-compat burden. Only if content value justifies it.
7. **Serve private lecture resources/PDFs the same way** — off the `public` disk, behind the same authenticated + signed route.
8. **Fix the current auth gaps** (all present today, all undermine any player hardening): sign+verify the Moyasar webhook; enforce `published()` + level entitlement in `Student\LectureController::show`; make `isSubscribed()` also check `expires_at`; validate `MediaService::upload()` mimetypes/size; add a CSP (`frame-ancestors 'self'`, restrict `script/media/frame-src`).

**Cosmetic extras** (right-click disable, moving overlay, disable native `<video>` download control, blur-on-blur) may be added as a *minor deterrent*, but must be documented to the owner as trivially bypassed and never counted as real protection.

**Upload/transcoding note (scale reality):** accepting raw teacher uploads and turning them into protected HLS needs a **background/queue transcoding step** (e.g. FFmpeg on a worker) — do not transcode inline in a web request. Match the existing `QUEUE_CONNECTION=database` + `queue:listen` setup. Validate uploads hard (mime allowlist, size cap) before storing.

**Secrets:** `.env` in this working copy contains **real production credentials** (DB and SMTP reuse the same password). Do **not** print them, commit them, or copy them into code/tests. Recommend the owner **rotate** them and use distinct secrets. Never run destructive artisan commands against that production DB.

---

## 8. Performance budget — "light and fast" for many students

- **Cache the homepage queries.** `HomeController::index` runs ~5 uncached queries per hit; wrap in `Cache::remember` keyed per locale. There is currently **zero** `Cache::` usage — add it where hot.
- **Self-host fonts** (drop unused weights) instead of render-blocking Google Fonts; **bundle Alpine.js via npm** instead of the jsDelivr CDN (removes third-party single points of failure).
- **Tame always-on animations / backdrop blur** behind `@media (prefers-reduced-motion: reduce)` — they burn GPU on low-end phones.
- **Images:** add `loading="lazy"` + `decoding="async"` + explicit `width/height` (avoid CLS); use thumbnails/`srcset` for photos.
- **Ship built assets** (`npm run build`) and on deploy run `php artisan config:cache route:cache view:cache`.
- **Every new query near a list/loop:** eager-load relations (`with(...)`) — watch for N+1.

---

## 9. i18n / RTL rules

- Arabic is the primary experience; the design is RTL-first. Confirm `APP_LOCALE` intent (config default is `en` but the whole UI assumes `ar`).
- New copy → keys in **both** `lang/ar/general.php` and `lang/en/general.php` (or `messages.php`). Do **not** rely on the `?? 'fallback'` idiom — it does not work for missing keys.
- Content model text → `_ar` + `_en` columns + accessor.
- Use logical CSS properties + `rtl:` variants; test both directions.

---

## 10. Danger zone — NEVER do these without explicit owner sign-off

- ❌ Run `php artisan migrate`/`migrate:fresh`/`db:*` against the real DB (always `--env=testing` for test runs; ask before touching prod).
- ❌ Edit, print, or commit `.env` / secrets. ❌ Weaken or remove an auth/subscription/ownership check to make something "work."
- ❌ Drop/rename DB columns, delete records, or run destructive shell commands.
- ❌ Introduce a new architectural pattern (FormRequests, Policies, a new frontend framework, a new payment SDK) as a side effect — propose it first.
- ❌ Add heavy dependencies, external CDNs, or blocking assets that hurt the performance budget.
- ❌ Report "done/tested" when the verification gate did not actually run to PASS.

---

## 11. Command cheat-sheet

```bash
composer install                     # FIRST — installs missing dev tooling (pest/pint/phpunit/faker)
composer test                        # full suite (clears config, then php artisan test)
php artisan test --filter=Name       # one test
vendor/bin/pint --test --dirty       # lint check (changed files only), no writes
vendor/bin/pint --dirty              # auto-format changed files
php -l app/Models/User.php           # syntax-check one PHP file
php artisan migrate:fresh --env=testing   # fresh TEST db (in-memory sqlite) — NEVER without --env=testing
npm run build                        # production assets   |   npm run dev = watch
php artisan view:clear               # after editing Blade/lang (compiled views are cached)
php artisan route:list               # verify routes resolve
```
Windows/PowerShell note: prefer `php artisan …` / `composer …` (cross-shell). For Pint use `php vendor/bin/pint …` if `vendor/bin/pint` isn't directly executable.

---

## 12. Where to look

- **Project hub (all new-project docs, mockups, design assets):** [`restrack-project/`](restrack-project/)
- **Product vision & full spec (positioning, personas, features, roles matrix, security/compliance, design system):** [`restrack-project/plan/MASTER_PLAN.md`](restrack-project/plan/MASTER_PLAN.md)
- **What to build (work order, level table, exact copy strings):** [`restrack-project/plan/ROADMAP.md`](restrack-project/plan/ROADMAP.md)
- **The strict verifier agent:** [`.claude/agents/regression-verifier.md`](.claude/agents/regression-verifier.md)
- **Program source PDF:** `C:\Users\b.maher\Downloads\Program 2.pdf`

---

*Constitution v1 — this document is strict on purpose. If a rule blocks something genuinely necessary,
raise it with the owner and amend the constitution; do not quietly ignore it.*
