<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ProDesk') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --pd-green:#12372A; --pd-green-2:#1d4d3c; --pd-green-3:#285f4b;
            --pd-gold:#C9A227; --pd-cream:#F7F5EF; --pd-charcoal:#202522;
        }
        *{ box-sizing:border-box; }
        html, body{ height:100%; margin:0; font-family:'figtree', system-ui, sans-serif; }

        .pd-auth-wrap{ min-height:100vh; display:flex; }

        .pd-auth-brand{
            flex:1 1 46%; display:flex; flex-direction:column; justify-content:center;
            padding:60px; color:#fff; position:relative; overflow:hidden;
            background:linear-gradient(150deg, var(--pd-green) 0%, var(--pd-green-2) 55%, var(--pd-green-3) 100%);
        }
        .pd-auth-brand::after{
            content:""; position:absolute; inset:0; pointer-events:none;
            background: radial-gradient(circle at 80% 20%, rgba(255,255,255,.08), transparent 45%);
        }
        .pd-brand-logo{ display:flex; align-items:center; gap:12px; margin-bottom:56px; position:relative; }
        .pd-brand-logo .ic{
            width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,var(--pd-gold),#e8c265);
            display:flex; align-items:center; justify-content:center; font-size:22px;
        }
        .pd-brand-logo b{ font-size:20px; display:block; line-height:1.1; }
        .pd-brand-logo small{ display:block; font-size:11px; opacity:.75; }

        .pd-auth-brand h1{ font-size:34px; font-weight:700; line-height:1.25; margin:0 0 14px; position:relative; max-width:440px; }
        .pd-auth-brand p.lead{ opacity:.8; font-size:15px; max-width:400px; margin:0 0 40px; position:relative; }

        .pd-feat-list{ display:flex; flex-direction:column; gap:16px; position:relative; }
        .pd-feat{ display:flex; align-items:center; gap:12px; font-size:14px; opacity:.92; }
        .pd-feat .ic{
            width:32px; height:32px; border-radius:9px; background:rgba(255,255,255,.14);
            display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0;
        }

        .pd-auth-form-side{
            flex:1 1 54%; display:flex; align-items:center; justify-content:center;
            background:var(--pd-cream); padding:40px;
        }
        .pd-auth-card{ width:100%; max-width:400px; background:#fff; border-radius:20px; padding:40px 36px; box-shadow:0 10px 40px rgba(18,55,42,.08); }
        .pd-auth-card .pd-card-logo{ display:flex; align-items:center; gap:10px; margin-bottom:26px; }
        .pd-auth-card .pd-card-logo .ic{
            width:36px; height:36px; border-radius:10px; background:linear-gradient(135deg,var(--pd-gold),#e8c265);
            display:flex; align-items:center; justify-content:center; font-size:18px;
        }
        .pd-auth-card .pd-card-logo b{ color:var(--pd-green); font-size:17px; }

        .pd-auth-card h2{ font-size:22px; font-weight:700; color:var(--pd-charcoal); margin:0 0 4px; }
        .pd-auth-card p.sub{ color:#999; font-size:13.5px; margin:0 0 26px; }

        /* Override Breeze default Tailwind input/button/link styling inside the auth card */
        .pd-auth-card label{
            font-weight:600 !important; font-size:13px !important; color:var(--pd-charcoal) !important;
            margin-bottom:6px !important; display:inline-block !important;
        }
        .pd-auth-card input[type="text"],
        .pd-auth-card input[type="email"],
        .pd-auth-card input[type="password"]{
            border-radius:10px !important; border:1.5px solid #e6e6e2 !important;
            padding:11px 14px !important; font-size:14px !important; width:100% !important;
            box-shadow:none !important; background:#fff !important;
        }
        .pd-auth-card input[type="text"]:focus,
        .pd-auth-card input[type="email"]:focus,
        .pd-auth-card input[type="password"]:focus{
            border-color:var(--pd-green) !important; box-shadow:0 0 0 3px rgba(18,55,42,0.08) !important;
            outline:none !important;
        }
        .pd-auth-card button[type="submit"]{
            background:var(--pd-green) !important; border-color:var(--pd-green) !important;
            border-radius:10px !important; padding:11px 22px !important; font-weight:600 !important;
            font-size:14px !important; width:100% !important; text-transform:none !important;
            letter-spacing:normal !important; box-shadow:none !important;
        }
        .pd-auth-card button[type="submit"]:hover{ background:var(--pd-green-2) !important; }
        .pd-auth-card a{ color:var(--pd-green) !important; }
        .pd-auth-card .flex.items-center.justify-end{ flex-direction:column-reverse !important; align-items:stretch !important; gap:14px !important; }
        .pd-auth-card .flex.items-center.justify-end a{ text-align:center !important; margin:0 !important; }

        .pd-auth-footer{ text-align:center; margin-top:22px; font-size:13.5px; color:#888; }
        .pd-auth-footer a{ color:var(--pd-green); font-weight:600; text-decoration:none; }

        @media (max-width: 900px){
            .pd-auth-wrap{ flex-direction:column; }
            .pd-auth-brand{ padding:36px 28px; flex:0 0 auto; }
            .pd-auth-brand h1{ font-size:24px; }
            .pd-feat-list{ display:none; }
            .pd-auth-form-side{ padding:28px; }
        }
    </style>
</head>
<body>
    <div class="pd-auth-wrap">

        <div class="pd-auth-brand">
            <div class="pd-brand-logo">
                <div class="ic">🏠</div>
                <div>
                    <b>ProDesk</b>
                    <small>Your Property Partner</small>
                </div>
            </div>

            <h1>Manage Properties Smarter, Faster.</h1>
            <p class="lead">Your Properties. One Digital Showroom. Everything you need to run your real-estate business, in one place.</p>

            <div class="pd-feat-list">
                <div class="pd-feat"><span class="ic">🏠</span> Keep properties organized</div>
                <div class="pd-feat"><span class="ic">👥</span> Manage clients</div>
                <div class="pd-feat"><span class="ic">🔔</span> Track follow-ups</div>
                <div class="pd-feat"><span class="ic">📱</span> Access anywhere</div>
            </div>
        </div>

        <div class="pd-auth-form-side">
            <div class="pd-auth-card">
                <div class="pd-card-logo">
                    <div class="ic">🏠</div>
                    <b>ProDesk</b>
                </div>

                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>