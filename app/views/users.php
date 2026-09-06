<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Directory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600&family=Space+Grotesk:wght@500;600;700&family=Syne:wght@700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            /* ── POLAR NIGHT, ARCTIC SUNRISE & ICE MIST PALETTE ── */
            --polar-night-darkest: #2E3440;
            --polar-night-dark: #3B4252;
            --polar-night-card: rgba(43, 48, 59, 0.85);
            
            --ice-mist-light: #E5E9F0;
            --ice-mist-bright: #ECEFF4;
            --ice-mist-muted: #88C0D0;
            
            --arctic-sunrise-gold: #EBCB8B;
            --arctic-sunrise-orange: #D08770;
            --arctic-sunrise-pink: #B48EAD;
            
            --border-color: rgba(136, 192, 208, 0.25);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            background: radial-gradient(circle at 50% -20%, #3B4252 0%, #2E3440 70%, #242933 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--ice-mist-light);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .preloader {
            position: fixed; inset: 0; z-index: 9999;
            background: #2E3440;
            display: flex; align-items: center; justify-content: center;
            flex-direction: column; gap: 20px;
        }
        .loader-bar-track {
            width: 200px; height: 3px;
            background: rgba(136, 192, 208, 0.15);
            border-radius: 4px; overflow: hidden;
        }
        .loader-bar {
            width: 0%; height: 100%;
            background: linear-gradient(90deg, #88C0D0, #EBCB8B);
            border-radius: 4px;
        }
        .loader-text {
            font-family: 'Space Grotesk', sans-serif;
            color: #88C0D0;
            font-size: 11px; font-weight: 600;
            letter-spacing: 0.25em; text-transform: uppercase;
        }

        .bg-grid-pattern {
            position: absolute; inset: 0;
            background-image: 
                linear-gradient(to right, rgba(229, 233, 240, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(229, 233, 240, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse at top, black 40%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse at top, black 40%, transparent 80%);
            pointer-events: none;
        }

        .header-section {
            position: relative;
            padding: 70px 24px 40px;
            text-align: center;
        }

        .glass-card {
            background: var(--polar-night-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(136, 192, 208, 0.45);
        }

        .glass-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .glass-table th {
            padding: 20px 24px;
            text-align: left;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #88C0D0;
            border-bottom: 1px solid rgba(136, 192, 208, 0.2);
            background: rgba(136, 192, 208, 0.05);
        }
        .glass-table tbody tr {
            border-bottom: 1px solid rgba(229, 233, 240, 0.05);
            transition: background 0.25s ease, transform 0.25s ease;
        }
        .glass-table tbody tr:hover {
            background: rgba(136, 192, 208, 0.08);
        }
        .glass-table td {
            padding: 18px 24px;
            font-size: 14px;
            color: #D8DEE9;
        }

        .cell-id {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #4C566A;
        }
        .cell-name {
            font-weight: 600;
            color: #ECEFF4;
        }
        
        /* HIGHLIGHTED EMAIL STYLING (Arctic Sunrise Gold Accent) */
        .cell-email {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: #EBCB8B !important;
            background: rgba(235, 203, 139, 0.1);
            border: 1px solid rgba(235, 203, 139, 0.25);
            padding: 6px 14px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 0 10px rgba(235, 203, 139, 0.12);
        }

        /* HIGHLIGHTED USERNAME STYLING (Ice Mist Cyan Accent) */
        .cell-username {
            font-family: 'Fira Code', monospace;
            font-weight: 600;
            color: #88C0D0 !important;
            background: rgba(136, 192, 208, 0.12);
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px dashed rgba(136, 192, 208, 0.3);
            display: inline-block;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .glass-table, .glass-table thead, .glass-table tbody, .glass-table th, .glass-table td, .glass-table tr {
                display: block;
            }
            .glass-table thead tr {
                position: absolute; top: -9999px; left: -9999px;
            }
            .glass-table tbody tr {
                border: 1px solid rgba(136, 192, 208, 0.2);
                border-radius: 16px;
                margin-bottom: 16px;
                padding: 12px;
                background: rgba(43, 48, 59, 0.6);
            }
            .glass-table td {
                border: none;
                position: relative;
                padding: 8px 12px 8px 45% !important;
                text-align: right;
            }
            .glass-table td::before {
                content: attr(data-label);
                position: absolute; left: 12px;
                font-family: 'Space Grotesk', sans-serif;
                font-size: 10px; font-weight: 700;
                letter-spacing: 0.1em; text-transform: uppercase;
                color: #88C0D0;
                text-align: left;
            }
        }
    </style>
</head>
<body>

    <div class="preloader" id="preloader">
        <div class="loader-text">Loading Directory</div>
        <div class="loader-bar-track">
            <div class="loader-bar" id="loaderBar"></div>
        </div>
    </div>

    <div class="bg-grid-pattern"></div>

    <section class="header-section">
        <h1 style="
            font-family: 'Syne', sans-serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #ECEFF4;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        ">Users Directory</h1>
        <p style="color: #D8DEE9; font-size: 14px;">List of registered accounts</p>
    </section>

    <section style="padding: 0 20px 60px; position: relative; z-index: 10;">
        <div style="max-width: 950px; margin: 0 auto;">

            <div class="glass-card" style="overflow: hidden;" id="mainContent">
                <table class="glass-table">
                    <thead>
                        <tr>
                            <th>
                                <div style="display:flex; align-items:center; gap:6px;">
                                    <i data-lucide="hash" style="width:14px; height:14px;"></i> ID
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:6px;">
                                    <i data-lucide="user" style="width:14px; height:14px;"></i> First Name
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:6px;">
                                    <i data-lucide="user" style="width:14px; height:14px;"></i> Last Name
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:6px;">
                                    <i data-lucide="mail" style="width:14px; height:14px; color:#EBCB8B;"></i> Email
                                </div>
                            </th>
                            <th>
                                <div style="display:flex; align-items:center; gap:6px;">
                                    <i data-lucide="at-sign" style="width:14px; height:14px; color:#88C0D0;"></i> Username
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td data-label="ID" class="cell-id">#<?php echo htmlspecialchars($user['id']); ?></td>
                                    <td data-label="First Name" class="cell-name"><?php echo htmlspecialchars($user['firstname']); ?></td>
                                    <td data-label="Last Name" class="cell-name"><?php echo htmlspecialchars($user['lastname']); ?></td>
                                    
                                    <td data-label="Email">
                                        <span class="cell-email">
                                            <i data-lucide="mail" style="width:12px; height:12px;"></i>
                                            <?php echo htmlspecialchars($user['email']); ?>
                                        </span>
                                    </td>
                                    
                                    <td data-label="Username">
                                        <span class="cell-username">@<?php echo htmlspecialchars($user['username']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center; padding: 40px; color: #4C566A;">No users found in database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <footer style="padding: 24px; text-align: center; border-top: 1px solid rgba(229, 233, 240, 0.05);">
        <p style="font-size: 12px; color: #4C566A;">&copy; <?php echo date('Y'); ?> Users Directory. All rights reserved.</p>
    </footer>

    <script>
        lucide.createIcons();

        const tl = gsap.timeline();
        tl.to('#loaderBar', {
            width: '100%',
            duration: 0.6,
            ease: 'power2.inOut'
        })
        .to('#preloader', {
            opacity: 0,
            duration: 0.4,
            onComplete: () => {
                document.getElementById('preloader').style.display = 'none';
            }
        })
        .from('#mainContent', {
            y: 30,
            opacity: 0,
            duration: 0.6,
            ease: 'power2.out'
        });
    </script>
</body>
</html>