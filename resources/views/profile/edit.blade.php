<x-app-layout>
    <x-slot name="header">
        <div>
            <div style="width:36px; height:4px; background:#C9A227; border-radius:4px; margin-bottom:10px;"></div>
            <h2 class="fw-bold mb-1" style="color:#12372A;">{{ __('Profile') }}</h2>
            <p class="text-muted mb-0">Manage your account information and security.</p>
        </div>
    </x-slot>

    <style>
        .pd-card{
            background:#fff; border-radius:18px; box-shadow:0 2px 10px rgba(0,0,0,.04); border:none;
            transition:box-shadow .18s ease;
        }
        .pd-card:hover{ box-shadow:0 8px 22px rgba(18,55,42,.07); }

        /* Section header (comes from the Breeze partial's own <header><h2>/<p>) */
        .pd-card header{ margin-bottom:22px; padding-bottom:16px; border-bottom:1px solid #f0f0ec; }
        .pd-card header h2{
            color:#12372A !important; font-size:16.5px !important; font-weight:700 !important;
            margin:0 0 4px !important; display:flex; align-items:center; gap:10px;
        }
        .pd-card header p{ color:#96a099 !important; font-size:13px !important; margin:0 !important; }

        .pd-card-profile header h2::before{ content:"👤"; font-size:15px; }
        .pd-card-password header h2::before{ content:"🔒"; font-size:15px; }
        .pd-card-danger header h2::before{ content:"⚠️"; font-size:15px; }

        .pd-card label{ font-weight:600 !important; font-size:13px !important; color:#202522 !important; }
        .pd-card input[type="text"],
        .pd-card input[type="email"],
        .pd-card input[type="password"]{
            border-radius:10px !important; border:1.5px solid #e6e6e2 !important;
            padding:10px 14px !important; font-size:14px !important; box-shadow:none !important;
        }
        .pd-card input:focus{
            border-color:#12372A !important; box-shadow:0 0 0 3px rgba(18,55,42,0.08) !important; outline:none !important;
        }
        .pd-card button[type="submit"]{
            background:#12372A !important; border-color:#12372A !important; border-radius:10px !important;
            padding:9px 22px !important; font-weight:600 !important; font-size:13.5px !important; box-shadow:none !important;
            transition:background .15s ease, transform .15s ease !important;
        }
        .pd-card button[type="submit"]:hover{ background:#1d4d3c !important; transform:translateY(-1px); }

        .pd-card-danger{ border:1.5px solid #f6c6c1 !important; background:#fffaf9; }
        .pd-card-danger header{ border-bottom-color:#fbe2dc; }
        .pd-card-danger header h2{ color:#c0392b !important; }
        .pd-card-danger button[type="submit"]{ background:#e0483a !important; border-color:#e0483a !important; }
        .pd-card-danger button[type="submit"]:hover{ background:#c73a2e !important; }

        .pd-danger-tag{
            display:inline-block; background:#fdecea; color:#c0392b; font-size:10.5px; font-weight:700;
            padding:3px 10px; border-radius:20px; letter-spacing:.4px; text-transform:uppercase; margin-bottom:10px;
        }
    </style>

    <div class="py-4">
        <div class="container" style="max-width: 760px;">
            <div class="d-flex flex-column gap-4">

                <div class="pd-card pd-card-profile p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="pd-card pd-card-password p-4">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="pd-card p-4 pd-card-danger">
                    <span class="pd-danger-tag">Danger Zone</span>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>