<!DOCTYPE html>
<html>
<head>
    <title>BACAY_StudentProfile</title>

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

        .profile-container {
            max-width: 850px;
            margin: 55px auto;
            padding: 0 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h1 {
            color: #146c43;
            margin-bottom: 8px;
            font-size: 36px;
        }

        .profile-header p {
            color: #64748b;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            color: #146c43;
            border-bottom: 2px solid #d1e7dd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .info {
            display: flex;
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info:last-child {
            border-bottom: none;
        }

        .label {
            width: 180px;
            font-weight: bold;
            color: #146c43;
        }

        .value {
            flex: 1;
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

            .info {
                flex-direction: column;
                gap: 5px;
            }

            .label {
                width: auto;
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

<div class="profile-container">

    <div class="profile-header">
        <h1>Student Profile</h1>
        <p>Mindoro State University · Calapan Campus</p>
    </div>

    <div class="profile-card">

        <h2 class="section-title">Personal & Academic Information</h2>

        <div class="info">
            <div class="label">Student ID</div>
            <div class="value"><?php echo $student_id; ?></div>
        </div>

        <div class="info">
            <div class="label">Name</div>
            <div class="value"><?php echo $name; ?></div>
        </div>

        <div class="info">
            <div class="label">Course</div>
            <div class="value"><?php echo $course; ?></div>
        </div>

        <div class="info">
            <div class="label">Year Level</div>
            <div class="value"><?php echo $year; ?></div>
        </div>

        <div class="info">
            <div class="label">Section</div>
            <div class="value"><?php echo $section; ?></div>
        </div>

        <div class="info">
            <div class="label">Email</div>
            <div class="value"><?php echo $email; ?></div>
        </div>

        <div class="info">
            <div class="label">Contact Number</div>
            <div class="value"><?php echo $contact; ?></div>
        </div>

        <div class="info">
            <div class="label">Hobby</div>
            <div class="value"><?php echo $hobby; ?></div>
        </div>

    </div>

</div>

<footer>
    Mindoro State University · Calapan Campus
</footer>

</body>
</html>