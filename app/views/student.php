<!DOCTYPE html>
<html>
<head>
    <title>Bacay_HOME</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f8f4;
            color: #1f2937;
        }

        header {
            background: #146c43;
            color: white;
            padding: 18px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 21px;
            font-weight: bold;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            max-width: 900px;
            margin: 60px auto;
            padding: 40px 30px;
            text-align: center;
        }

        .hero h1 {
            color: #146c43;
            font-size: 42px;
            margin-bottom: 35px;
        }

        .student-card {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 35px 40px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 5px solid #198754;
        }

        .student-card h2 {
            color: #146c43;
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .info-row span {
            color: #64748b;
            font-weight: bold;
        }

        .info-row strong {
            color: #1f2937;
            text-align: right;
            max-width: 65%;
        }

        .profile-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 24px;
            background: #198754;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .profile-btn:hover {
            background: #146c43;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            header {
                padding: 18px 20px;
                flex-direction: column;
                gap: 15px;
            }

            nav a {
                margin: 0 8px;
            }

            .hero {
                margin: 30px auto;
                padding: 30px 20px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .student-card {
                padding: 25px 20px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .info-row strong {
                max-width: 100%;
                text-align: left;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">🌿 MINSU Student Portal</div>

    <nav>
        <a href="<?= site_url('student'); ?>">Home</a>
        <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
    </nav>
</header>

<section class="hero">

    <h1>Welcome to My Student Portal</h1>

    <div class="student-card">

        <h2><?php echo $name; ?></h2>

        <div class="info-row">
            <span>Course</span>
            <strong><?php echo $course; ?></strong>
        </div>

        <div class="info-row">
            <span>Year Level</span>
            <strong><?php echo $year; ?></strong>
        </div>

        <div class="info-row">
            <span>Section</span>
            <strong><?php echo $section; ?></strong>
        </div>

    </div>

</section>

<footer>
    Mindoro State University · Calapan Campus
</footer>

</body>
</html>
