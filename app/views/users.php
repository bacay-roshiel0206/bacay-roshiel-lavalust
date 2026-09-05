<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Directory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Space+Grotesk:wght@500;600;700&family=Syne:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.33/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Syne', 'sans-serif'],
                        heading: ['Space Grotesk', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                        code: ['Fira Code', 'monospace']
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            /* ── ENHANCED DARK THEME COLOR PALETTE ── */
            --c-bg: #04080F;
            --c-card: #0A111E;
            --c-dark: #04080F;
            --c-border: rgba(16, 185, 129, 0.22);
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --primary: #10B981;    /* Emerald Green */
            --accent-cyan: #06B6D4;/* Bright Cyan for Email */
            --accent-blue: #38BDF8;/* Sky Blue for Username */
            --text-main: #F1F5F9;  /* Crisp White */
            --text-muted: #94A3B8; /* Slate Light */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { font-family: 'Inter', sans-serif; background: var(--c-dark); }
        body { background: var(--c-dark); overflow-x: hidden; color: var(--text-main); }

        /* ── Preloader ── */
        .preloader {
            position: fixed; inset: 0; z-index: 9999;
            background: var(--c-dark);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column; gap: 24px;
            clip-path: inset(0 0 0% 0);
        }
        .loader-bar-track {
            width: 220px; height: 3px;
            background: rgba(16, 185, 129, 0.15);
            border-radius: 4px; overflow: hidden;
        }
        .loader-bar {
            width: 0%; height: 100%;
            background: linear-gradient(90deg, #10B981, #06B6D4, #3B82F6);
            border-radius: 4px;
        }
        .loader-text {
            font-family: 'Space Grotesk', sans-serif;
            color: #10B981;
            font-size: 12px; font-weight: 600;
            letter-spacing: 0.25em; text-transform: uppercase;
        }

        /* ── Noise Overlay ── */
        .noise {
            position: fixed; inset: 0; z-index: 9998;
            pointer-events: none; opacity: 0.035;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* ── Parallax Header ── */
        .parallax-header {
            position: relative;
            height: 52vh; min-height: 380px;
            display: flex; align-items: flex-end; justify-content: center;
            overflow: hidden;
        }
        .parallax-bg {
            position: absolute; inset: -20%;
            background: url('https://picsum.photos/seed/tech-users-network/1920/1080.jpg') center/cover no-repeat;
            will-change: transform;
            filter: brightness(0.18) saturate(1.4) hue-rotate(130deg);
        }
        .parallax-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg,
                rgba(4, 8, 15, 0.3) 0%,
                rgba(4, 8, 15, 0.75) 65%,
                rgba(4, 8, 15, 1) 100%
            );
        }
        .parallax-grid {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.07) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse at center, black 35%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 35%, transparent 75%);
        }

        /* ── Floating Orbs ── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.3;
            will-change: transform;
            pointer-events: none;
        }
        .orb-1 {
            width: 380px; height: 380px;
            background: #10B981;
            top: -15%; left: -5%;
            animation: float-orb 14s ease-in-out infinite;
        }
        .orb-2 {
            width: 300px; height: 300px;
            background: #3B82F6;
            bottom: -10%; right: -3%;
            animation: float-orb 11s ease-in-out infinite reverse;
        }
        .orb-3 {
            width: 220px; height: 220px;
            background: #06B6D4;
            top: 25%; right: 25%;
            animation: float-orb 9s ease-in-out infinite 3s;
        }
        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(25px, -35px) scale(1.08); }
            66% { transform: translate(-18px, 15px) scale(0.94); }
        }

        /* ── Glassmorphism Card ── */
        .glass-card {
            background: rgba(10, 17, 30, 0.75);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(16, 185, 129, 0.22);
            border-radius: 24px;
            box-shadow:
                0 15px 45px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transition: all 0.6s var(--ease-out);
        }
        .glass-card:hover {
            background: rgba(10, 17, 30, 0.85);
            border-color: rgba(16, 185, 129, 0.45);
            box-shadow:
                0 18px 55px rgba(0, 0, 0, 0.7),
                0 0 45px rgba(16, 185, 129, 0.12);
        }

        /* ── Glass Table ── */
        .glass-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            position: relative;
            z-index: 1;
        }
        .glass-table th {
            padding: 22px 30px;
            text-align: left;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #34D399; /* Bright Emerald */
            border-bottom: 1px solid rgba(16, 185, 129, 0.2);
            background: rgba(16, 185, 129, 0.04);
        }
        .glass-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.35s var(--ease-out);
        }
        .glass-table tbody tr:last-child {
            border-bottom: none;
        }
        .glass-table tbody tr:hover {
            background: rgba(16, 185, 129, 0.08);
        }
        
        /* Table Cell Base Styling */
        .glass-table td {
            padding: 20px 30px;
            font-size: 14px;
            font-weight: 400;
            color: var(--text-muted);
            transition: all 0.35s var(--ease-out);
        }
        
        /* ID Column */
        .cell-id {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #64748B !important;
            font-size: 13px;
        }
        
        /* Name Columns */
        .cell-name {
            font-weight: 600;
            color: #F1F5F9 !important;
            font-size: 15px;
        }

        /* ── HIGHLIGHTED EMAIL COLUMN ── */
        .cell-email {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: #22D3EE !important; /* Vivid Cyan */
            background: linear-gradient(90deg, rgba(6, 182, 212, 0.08), transparent);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px !important;
            margin: 12px 0;
            border: 1px solid rgba(6, 182, 212, 0.2);
            text-shadow: 0 0 12px rgba(6, 182, 212, 0.3);
        }

        /* ── HIGHLIGHTED USERNAME COLUMN ── */
        .cell-username {
            font-family: 'Fira Code', monospace;
            font-weight: 600;
            color: #A7F3D0 !important; /* Soft Emerald Cyan */
            background: rgba(16, 185, 129, 0.12);
            padding: 5px 12px !important;
            border-radius: 6px;
            border: 1px dashed rgba(16, 185, 129, 0.3);
            display: inline-block;
            font-size: 13px;
        }

        .glass-table tbody tr:hover .cell-name {
            color: #38BDF8 !important; /* Sky Blue highlight on row hover */
        }

        /* ── Back Link Floating ── */
        .back-float {
            position: fixed;
            top: 28px; left: 28px;
            z-index: 100;
            display: flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            background: rgba(4, 8, 15, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 100px;
            color: #10B981;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11px; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            text-decoration: none;
            transition: all 0.4s var(--ease-out);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }
        .back-float:hover {
            color: #FFFFFF;
            border-color: rgba(16, 185, 129, 0.6);
            background: rgba(16, 185, 129, 0.2);
            transform: translateY(-2px);
        }
        .back-float .back-arrow {
            transition: transform 0.4s var(--ease-out);
        }
        .back-float:hover .back-arrow {
            transform: translateX(-4px);
        }

        /* ── Decorative Ring ── */
        .deco-ring {
            position: absolute;
            border: 1px solid rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ── Reveal Animations ── */
        .reveal-up {
            opacity: 0;
            transform: translateY(60px);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
        }

        /* ── Status Tag ── */
        .status-tag {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 100px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 0.2em; text-transform: uppercase;
            color: #34D399;
        }
        .status-dot {
            width: 6px; height: 6px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 10px #10B981;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        /* ── Footer Glass ── */
        .footer-glass {
            background: rgba(4, 8, 15, 0.85);
            backdrop-filter: blur(16px);
            border-top: 1px solid rgba(16, 185, 129, 0.15);
        }

        /* ── Custom Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--c-dark); }
        ::-webkit-scrollbar-thumb { background: rgba(16, 185, 129, 0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(16, 185, 129, 0.5); }

        /* ── Responsive Mobile ── */
        @media (max-width: 768px) {
            .glass-table, .glass-table thead, .glass-table tbody, .glass-table th, .glass-table td, .glass-table tr {
                display: block;
            }
            .glass-table thead tr {
                position: absolute; top: -9999px; left: -9999px;
            }
            .glass-table tbody tr {
                border: 1px solid rgba(16, 185, 129, 0.2);
                border-radius: 18px;
                margin-bottom: 20px;
                padding: 16px;
                background: rgba(10, 17, 30, 0.6);
            }
            .glass-table td {
                border: none;
                position: relative;
                padding: 10px 16px 10px 45% !important;
                text-align: right;
            }
            .glass-table td::before {
                content: attr(data-label);
                position: absolute; left: 16px;
                font-family: 'Space Grotesk', sans-serif;
                font-size: 10px; font-weight: 700;
                letter-spacing: 0.15em; text-transform: uppercase;
                color: #10B981;
                text-align: left;
            }
            .cell-email, .cell-username {
                display: inline-block;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Back Button -->
    <a href="#" onclick="window.history.back(); return false;" class="back-float" id="backBtn">
        <i data-lucide="arrow-left" class="back-arrow" style="width:14px; height:14px;"></i>
        <span>Back</span>
    </a>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="loader-text">Loading Directory</div>
        <div class="loader-bar-track">
            <div class="loader-bar" id="loaderBar"></div>
        </div>
    </div>

    <!-- Noise Overlay -->
    <div class="noise"></div>

    <!-- ════════════════════════════════════════ -->
    <!-- PARALLAX HEADER                          -->
    <!-- ════════════════════════════════════════ -->
    <section class="parallax-header">
        <div class="parallax-bg" id="parallaxBg"></div>
        <div class="parallax-overlay"></div>
        <div class="parallax-grid"></div>

        <!-- Floating Orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Decorative Rings -->
        <div class="deco-ring" style="width:500px;height:500px;bottom:-30%;left:-10%;"></div>
        <div class="deco-ring" style="width:700px;height:700px;bottom:-45%;left:-18%;"></div>

        <!-- Header Content -->
        <div style="position:relative;z-index:10;width:90%;max-width:1000px;padding-bottom:48px;">
            <div class="reveal-up">
                <div class="status-tag" style="margin-bottom:20px;">
                    <span class="status-dot"></span>
                    System Active
                </div>
                <h1 style="
                    font-family: 'Syne', sans-serif;
                    font-size: clamp(34px, 5.5vw, 54px);
                    font-weight: 800;
                    line-height: 1.05;
                    letter-spacing: -0.03em;
                    color: #FFFFFF;
                    margin-bottom: 8px;
                ">Users Directory</h1>
                <p style="
                    font-size: 15px; font-weight: 400;
                    color: #94A3B8;
                    letter-spacing: 0.02em;
                ">Complete registry of registered platform users</p>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════ -->
    <!-- USERS TABLE SECTION                      -->
    <!-- ════════════════════════════════════════ -->
    <section style="padding: 0 24px 80px; position: relative; margin-top: -40px; z-index: 20;">
        <div style="max-width: 1000px; margin: 0 auto;">

            <!-- Main Glass Card containing Table -->
            <div class="glass-card reveal-scale" style="padding: 0; overflow: hidden; position: relative;">

                <!-- Subtle corner glows -->
                <div style="
                    position: absolute; top: -60px; right: -60px;
                    width: 220px; height: 220px;
                    background: radial-gradient(circle, rgba(16,185,129,0.18), transparent 70%);
                    pointer-events: none; z-index: 0;
                "></div>
                <div style="
                    position: absolute; bottom: -40px; left: -40px;
                    width: 180px; height: 180px;
                    background: radial-gradient(circle, rgba(6,182,212,0.12), transparent 70%);
                    pointer-events: none; z-index: 0;
                "></div>

                <table class="glass-table">
                    <thead>
                        <tr>
                            <th>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <i data-lucide="hash" style="width:14px; height:14px; opacity:0.8;"></i>
                                    ID
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <i data-lucide="user" style="width:14px; height:14px; opacity:0.8;"></i>
                                    First Name
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <i data-lucide="user" style="width:14px; height:14px; opacity:0.8;"></i>
                                    Last Name
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <i data-lucide="mail" style="width:14px; height:14px; color:#22D3EE;"></i>
                                    Email
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <i data-lucide="at-sign" style="width:14px; height:14px; color:#34D399;"></i>
                                    Username
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)): ?>
                            <?php foreach ($users as $index => $user): ?>
                                <tr class="reveal-up" style="transition-delay: <?= $index * 0.05 ?>s;">
                                    <td data-label="ID" class="cell-id">#<?= htmlspecialchars($user['id']) ?></td>
                                    <td data-label="First Name" class="cell-name"><?= htmlspecialchars($user['firstname']) ?></td>
                                    <td data-label="Last Name" class="cell-name"><?= htmlspecialchars($user['lastname']) ?></td>
                                    
                                    <!-- Highlighted Email -->
                                    <td data-label="Email">
                                        <span class="cell-email">
                                            <i data-lucide="mail" style="width:12px; height:12px;"></i>
                                            <?= htmlspecialchars($user['email']) ?>
                                        </span>
                                    </td>
                                    
                                    <!-- Highlighted Username -->
                                    <td data-label="Username">
                                        <span class="cell-username">@<?= htmlspecialchars($user['username']) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center; padding: 48px; color: #64748B; font-family:'Space Grotesk', sans-serif;">
                                    No users found in database.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════════════ -->
    <!-- FOOTER                                   -->
    <!-- ════════════════════════════════════════ -->
    <footer class="footer-glass" style="padding: 32px 24px;">
        <div style="max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <span style="
                font-family: 'Space Grotesk', sans-serif;
                font-size: 13px; font-weight: 600;
                color: #64748B;
                letter-spacing: -0.01em;
            ">Users Directory</span>
            <span style="
                font-size: 11px; font-weight: 400;
                color: #475569;
            ">&copy; <?= date('Y') ?> All rights reserved.</span>
        </div>
    </footer>

    <!-- ════════════════════════════════════════ -->
    <!-- SCRIPTS                                  -->
    <!-- ════════════════════════════════════════ -->
    <script>
        // ── Initialize Lucide Icons ──
        lucide.createIcons();

        // ── Lenis Smooth Scroll ──
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smooth: true,
        });
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // ── Preloader ──
        const tl = gsap.timeline();
        tl.to('#loaderBar', {
            width: '100%',
            duration: 1.0,
            ease: 'power2.inOut',
        })
        .to('.loader-text', {
            y: -20, opacity: 0,
            duration: 0.4,
            ease: 'power2.in',
        }, '-=0.3')
        .to('#preloader', {
            clipPath: 'inset(0 0 100% 0)',
            duration: 0.8,
            ease: 'power4.inOut',
            onComplete: () => {
                document.getElementById('preloader').style.display = 'none';
                initAnimations();
            }
        }, '-=0.1');

        function initAnimations() {
            gsap.registerPlugin(ScrollTrigger);

            // Show back button
            gsap.to('#backBtn', {
                opacity: 1, y: 0,
                duration: 0.6,
                ease: 'power3.out',
                delay: 0.3,
            });

            // Reveal Up
            gsap.utils.toArray('.reveal-up').forEach((el) => {
                gsap.to(el, {
                    y: 0, opacity: 1,
                    duration: 0.9,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                        toggleActions: 'play none none none',
                    }
                });
            });

            // Reveal Scale
            gsap.utils.toArray('.reveal-scale').forEach((el) => {
                gsap.to(el, {
                    scale: 1, opacity: 1,
                    duration: 1.1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 88%',
                        toggleActions: 'play none none none',
                    }
                });
            });

            // ── Parallax Background ──
            gsap.to('#parallaxBg', {
                yPercent: 25,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.parallax-header',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                }
            });

            // ── Orbs Parallax ──
            gsap.to('.orb-1', {
                yPercent: -25, xPercent: 8,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.parallax-header',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                }
            });
            gsap.to('.orb-2', {
                yPercent: -12, xPercent: -6,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.parallax-header',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                }
            });
            gsap.to('.orb-3', {
                yPercent: -20, xPercent: 5,
                ease: 'none',
                scrollTrigger: {
                    trigger: '.parallax-header',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                }
            });

            // ── Decorative Rings ──
            gsap.utils.toArray('.deco-ring').forEach((ring, i) => {
                gsap.to(ring, {
                    yPercent: -(8 + i * 6),
                    rotation: i % 2 === 0 ? 10 : -10,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: '.parallax-header',
                        start: 'top top',
                        end: 'bottom top',
                        scrub: true,
                    }
                });
            });
        }
    </script>

</body>
</html>