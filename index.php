<?php
// Simula ng PHP script para sa grade calculator
// Start ng PHP script para sa grade calculator

// Pagsusuri kung may na-submit na form data
// Checking kung may na-submit na form data
$result = '';
$error = '';
$quiz_score = '';
$assignment_score = '';
$exam_score = '';
$weighted_average = 0;
$letter_grade = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kunin ang mga input values mula sa form
    // Get ang mga input values mula sa form
    $quiz_score = $_POST['quiz'] ?? '';
    $assignment_score = $_POST['assignment'] ?? '';
    $exam_score = $_POST['exam'] ?? '';
    
    // I-validate kung lahat ng fields ay filled
    // Validate kung lahat ng fields ay filled
    if (empty($quiz_score) || empty($assignment_score) || empty($exam_score)) {
        $error = 'Lahat ng fields ay dapat na may laman. / All fields must be filled.';
    }
    // I-validate kung numeric ang lahat ng inputs
    // Validate kung numeric ang lahat ng inputs
    elseif (!is_numeric($quiz_score) || !is_numeric($assignment_score) || !is_numeric($exam_score)) {
        $error = 'Lahat ng scores ay dapat na numero. / All scores must be numeric.';
    }
    // I-validate kung nasa range ng 0-100 ang lahat ng scores
    // Validate kung nasa range ng 0-100 ang lahat ng scores
    elseif ($quiz_score < 0 || $quiz_score > 100 || 
            $assignment_score < 0 || $assignment_score > 100 || 
            $exam_score < 0 || $exam_score > 100) {
        $error = 'Lahat ng scores ay dapat nasa pagitan ng 0 at 100. / All scores must be between 0 and 100.';
    } else {
        // I-convert ang strings sa float para sa calculation
        // Convert ang strings sa float para sa calculation
        $quiz_score = floatval($quiz_score);
        $assignment_score = floatval($assignment_score);
        $exam_score = floatval($exam_score);
        
        // I-calculate ang weighted average
        // Calculate ang weighted average
        // Quiz: 30%, Assignment: 30%, Exam: 40%
        $weighted_average = ($quiz_score * 0.30) + ($assignment_score * 0.30) + ($exam_score * 0.40);
        
        // I-determine ang letter grade base sa grading scale
        // Determine ang letter grade base sa grading scale
        if ($weighted_average >= 90) {
            $letter_grade = 'A';
        } elseif ($weighted_average >= 80) {
            $letter_grade = 'B';
        } elseif ($weighted_average >= 70) {
            $letter_grade = 'C';
        } elseif ($weighted_average >= 60) {
            $letter_grade = 'D';
        } else {
            $letter_grade = 'F';
        }
        
        // I-format ang result message
        // Format ang result message
        $grade_emoji = '';
        if ($letter_grade == 'A') $grade_emoji = '🌟';
        elseif ($letter_grade == 'B') $grade_emoji = '👍';
        elseif ($letter_grade == 'C') $grade_emoji = '👌';
        elseif ($letter_grade == 'D') $grade_emoji = '⚠️';
        else $grade_emoji = '❌';
        
        $result = sprintf(
            '🎯 Your Final Score:<br><strong>Weighted Average: %.2f%%</strong><br>%s <strong>Letter Grade: %s</strong><br><small>Great job! Keep up the good work! 🎉</small>',
            $weighted_average,
            $grade_emoji,
            $letter_grade
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS styling para sa girly cutesy theme */
        /* CSS styling para sa girly cutesy theme */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comfortaa', cursive;
            background: 
                radial-gradient(
                    circle at 10% 20%,
                    rgba(255, 218, 185, 0.5) 0%,
                    transparent 40%
                ),
                radial-gradient(
                    circle at 90% 10%,
                    rgba(186, 85, 211, 0.3) 0%,
                    transparent 45%
                ),
                radial-gradient(
                    circle at 30% 70%,
                    rgba(255, 105, 180, 0.4) 0%,
                    transparent 40%
                ),
                radial-gradient(
                    circle at 70% 80%,
                    rgba(173, 216, 230, 0.4) 0%,
                    transparent 45%
                ),
                conic-gradient(
                    from 0deg at 25% 25%,
                    rgba(255, 215, 0, 0.2) 0deg,
                    rgba(255, 192, 203, 0.2) 60deg,
                    rgba(221, 160, 221, 0.2) 120deg,
                    rgba(255, 218, 185, 0.2) 180deg,
                    rgba(173, 216, 230, 0.2) 240deg,
                    rgba(255, 215, 0, 0.2) 300deg,
                    rgba(255, 215, 0, 0.2) 360deg
                ),
                conic-gradient(
                    from 45deg at 75% 75%,
                    rgba(255, 105, 180, 0.15) 0deg,
                    rgba(186, 85, 211, 0.15) 72deg,
                    rgba(255, 218, 185, 0.15) 144deg,
                    rgba(173, 216, 230, 0.15) 216deg,
                    rgba(255, 192, 203, 0.15) 288deg,
                    rgba(255, 105, 180, 0.15) 360deg
                ),
                repeating-linear-gradient(
                    135deg,
                    rgba(255, 228, 225, 0.6) 0px,
                    rgba(255, 228, 225, 0.6) 15px,
                    rgba(230, 230, 250, 0.4) 15px,
                    rgba(230, 230, 250, 0.4) 30px,
                    rgba(255, 240, 245, 0.5) 30px,
                    rgba(255, 240, 245, 0.5) 45px,
                    rgba(255, 218, 185, 0.3) 45px,
                    rgba(255, 218, 185, 0.3) 60px
                ),
                linear-gradient(
                    to bottom,
                    rgba(255, 248, 220, 0.8) 0%,
                    rgba(255, 240, 245, 0.6) 50%,
                    rgba(230, 230, 250, 0.7) 100%
                );
            color: #000000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: enchantedGlow 15s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(255, 215, 0, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 45% 25%, rgba(255, 192, 203, 0.1) 1.5px, transparent 1.5px),
                radial-gradient(circle at 75% 35%, rgba(186, 85, 211, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 25% 55%, rgba(255, 105, 180, 0.1) 1.8px, transparent 1.8px),
                radial-gradient(circle at 85% 65%, rgba(173, 216, 230, 0.1) 1.2px, transparent 1.2px),
                radial-gradient(circle at 35% 85%, rgba(255, 218, 185, 0.1) 2.2px, transparent 2.2px);
            background-size: 80px 80px, 120px 120px, 60px 60px, 100px 100px, 90px 90px, 110px 110px;
            animation: magicalSparkles 20s linear infinite;
            pointer-events: none;
            z-index: -1;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            background: 
                repeating-linear-gradient(
                    90deg,
                    rgba(255, 215, 0, 0.05) 0px,
                    rgba(255, 215, 0, 0.05) 30px,
                    rgba(255, 192, 203, 0.05) 30px,
                    rgba(255, 192, 203, 0.05) 60px,
                    rgba(186, 85, 211, 0.05) 60px,
                    rgba(186, 85, 211, 0.05) 90px
                ),
                linear-gradient(
                    to top,
                    rgba(255, 228, 225, 0.3) 0%,
                    transparent 100%
                );
            pointer-events: none;
            z-index: -1;
        }

        @keyframes enchantedGlow {
            0% { filter: brightness(1) saturate(1) hue-rotate(0deg); }
            20% { filter: brightness(1.03) saturate(1.05) hue-rotate(2deg); }
            40% { filter: brightness(1) saturate(1) hue-rotate(0deg); }
            60% { filter: brightness(1.02) saturate(1.03) hue-rotate(-1deg); }
            80% { filter: brightness(1.01) saturate(1.02) hue-rotate(1deg); }
            100% { filter: brightness(1) saturate(1) hue-rotate(0deg); }
        }

        @keyframes magicalSparkles {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(360deg); }
        }

        .magical-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .crown {
            position: absolute;
            top: 8%;
            left: 3%;
            font-size: 2.2em;
            opacity: 0.25;
            animation: royalFloat 7s ease-in-out infinite;
        }

        .castle {
            position: absolute;
            bottom: 8%;
            right: 3%;
            font-size: 2.8em;
            opacity: 0.3;
            animation: royalFloat 9s ease-in-out infinite reverse;
        }

        .wand {
            position: absolute;
            top: 20%;
            right: 8%;
            font-size: 1.8em;
            opacity: 0.2;
            animation: wandTwirl 6s linear infinite;
        }

        .tiara {
            position: absolute;
            bottom: 25%;
            left: 8%;
            font-size: 2em;
            opacity: 0.25;
            animation: royalFloat 8s ease-in-out infinite;
        }

        @keyframes royalFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.25; }
            25% { transform: translateY(-12px) rotate(2deg); opacity: 0.35; }
            50% { transform: translateY(-6px) rotate(0deg); opacity: 0.3; }
            75% { transform: translateY(-18px) rotate(-2deg); opacity: 0.4; }
        }

        @keyframes wandTwirl {
            0% { transform: rotate(0deg) translateY(0px); }
            25% { transform: rotate(90deg) translateY(-5px); }
            50% { transform: rotate(180deg) translateY(-2px); }
            75% { transform: rotate(270deg) translateY(-8px); }
            100% { transform: rotate(360deg) translateY(0px); }
        }

        .container {
            background: linear-gradient(135deg, #fff5fd 0%, #f8f4ff 50%, #fff0f8 100%);
            color: #000000;
            border-radius: 30px;
            box-shadow: 
                0 25px 50px rgba(218, 112, 214, 0.3),
                inset 0 2px 0 rgba(255, 255, 255, 0.8);
            padding: 45px;
            max-width: 650px;
            width: 100%;
            border: 4px solid transparent;
            background-clip: padding-box;
            position: relative;
            backdrop-filter: blur(15px);
        }

        .container::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            background: repeating-linear-gradient(
                90deg,
                #da70d6 0%,
                #87ceeb 25%,
                #ffc0cb 50%,
                #dda0dd 75%,
                #da70d6 100%
            );
            border-radius: 30px;
            z-index: -1;
            animation: borderGlow 4s ease-in-out infinite;
        }

        @keyframes borderGlow {
            0% { filter: brightness(1); }
            50% { filter: brightness(1.3) drop-shadow(0 0 20px rgba(218, 112, 214, 0.5)); }
            100% { filter: brightness(1); }
        }

        h1 {
            text-align: center;
            margin-bottom: 35px;
            font-size: 3.2em;
            font-weight: 700;
            font-family: 'Dancing Script', cursive;
            background: linear-gradient(
                45deg,
                #da70d6,
                #87ceeb,
                #ffc0cb,
                #dda0dd,
                #ffb6c1
            );
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: none;
            letter-spacing: 1px;
            animation: textShimmer 3s ease-in-out infinite;
            text-shadow: 2px 2px 8px rgba(218, 112, 214, 0.3);
        }

        @keyframes textShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 700;
            font-size: 1.3em;
            background: linear-gradient(
                45deg,
                #da70d6,
                #87ceeb,
                #ffc0cb
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: none;
            letter-spacing: 1px;
        }

        input[type="number"] {
            width: 100%;
            padding: 20px;
            border: 3px solid transparent;
            border-radius: 20px;
            font-size: 1.2em;
            background: linear-gradient(#fff8fd, #fff8fd) padding-box,
                        linear-gradient(
                            90deg,
                            #da70d6,
                            #87ceeb,
                            #ffc0cb,
                            #dda0dd
                        ) border-box;
            color: #444;
            transition: all 0.4s ease;
            font-weight: 600;
            box-shadow: inset 0 2px 8px rgba(218, 112, 214, 0.1);
        }

        input[type="number"]:focus {
            outline: none;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 12px 25px rgba(218, 112, 214, 0.3),
                0 0 20px rgba(135, 206, 235, 0.2),
                inset 0 2px 8px rgba(255, 182, 193, 0.2);
        }

        input[type="number"]:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 8px 20px rgba(218, 112, 214, 0.2),
                inset 0 2px 8px rgba(255, 192, 203, 0.1);
        }

        .weights-info {
            background: repeating-linear-gradient(
                45deg,
                rgba(218, 112, 214, 0.15),
                rgba(218, 112, 214, 0.15) 12px,
                rgba(255, 192, 203, 0.15) 12px,
                rgba(255, 192, 203, 0.15) 24px,
                rgba(135, 206, 235, 0.15) 24px,
                rgba(135, 206, 235, 0.15) 36px
            );
            border: 3px solid transparent;
            background-clip: padding-box;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(218, 112, 214, 0.2);
        }

        .weights-info::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            background: linear-gradient(
                90deg,
                #da70d6,
                #87ceeb,
                #ffc0cb,
                #dda0dd
            );
            border-radius: 20px;
            z-index: -1;
        }

        .weights-info h3 {
            margin-bottom: 18px;
            background: linear-gradient(45deg, #da70d6, #87ceeb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.5em;
            font-weight: 800;
        }

        .weights-info p {
            margin: 10px 0;
            color: #666;
            font-weight: 600;
            font-size: 1.2em;
        }

        .submit-btn {
            width: 100%;
            padding: 25px;
            background: linear-gradient(
                45deg,
                #da70d6,
                #87ceeb,
                #ffc0cb,
                #dda0dd,
                #ffb6c1
            );
            background-size: 400% 400%;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            font-size: 1.4em;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.4s ease;
            text-transform: none;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(218, 112, 214, 0.5);
            position: relative;
            overflow: hidden;
            animation: buttonPulse 3s ease-in-out infinite;
            box-shadow: 0 8px 25px rgba(218, 112, 214, 0.4);
        }

        @keyframes buttonPulse {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .submit-btn::before {
            content: '✨';
            position: absolute;
            top: 50%;
            left: -50px;
            transform: translateY(-50%);
            font-size: 1.5em;
            animation: sparkleMove 2s linear infinite;
        }

        @keyframes sparkleMove {
            0% { left: -50px; opacity: 0; }
            50% { opacity: 1; }
            100% { left: calc(100% + 50px); opacity: 0; }
        }

        .submit-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 15px 35px rgba(218, 112, 214, 0.5),
                0 5px 20px rgba(135, 206, 235, 0.3);
        }

        .result {
            margin-top: 30px;
            padding: 30px;
            background: linear-gradient(
                135deg,
                #da70d6,
                #87ceeb,
                #ffc0cb
            );
            color: #ffffff;
            border-radius: 25px;
            text-align: center;
            font-size: 1.6em;
            font-weight: 700;
            border: 4px solid #da70d6;
            box-shadow: 
                0 12px 30px rgba(218, 112, 214, 0.4),
                inset 0 2px 0 rgba(255, 255, 255, 0.3);
            text-shadow: 2px 2px 8px rgba(218, 112, 214, 0.6);
            animation: resultGlow 2s ease-in-out infinite;
        }

        @keyframes resultGlow {
            0% { box-shadow: 0 12px 30px rgba(218, 112, 214, 0.4), inset 0 2px 0 rgba(255, 255, 255, 0.3); }
            50% { box-shadow: 0 15px 40px rgba(218, 112, 214, 0.6), inset 0 2px 0 rgba(255, 255, 255, 0.4); }
            100% { box-shadow: 0 12px 30px rgba(218, 112, 214, 0.4), inset 0 2px 0 rgba(255, 255, 255, 0.3); }
        }

        .error {
            margin-top: 30px;
            padding: 25px;
            background: linear-gradient(
                135deg,
                #ff69b4,
                #ff1493
            );
            color: #ffffff;
            border: 3px solid #ff69b4;
            border-radius: 25px;
            text-align: center;
            font-size: 1.4em;
            font-weight: 700;
            box-shadow: 
                0 10px 30px rgba(255, 105, 180, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            text-shadow: 2px 2px 6px rgba(255, 20, 147, 0.5);
        }

        .grading-scale {
            background: repeating-linear-gradient(
                135deg,
                rgba(218, 112, 214, 0.12),
                rgba(218, 112, 214, 0.12) 18px,
                rgba(135, 206, 235, 0.12) 18px,
                rgba(135, 206, 235, 0.12) 36px,
                rgba(255, 192, 203, 0.12) 36px,
                rgba(255, 192, 203, 0.12) 54px
            );
            border: 3px solid transparent;
            background-clip: padding-box;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 8px 25px rgba(218, 112, 214, 0.2);
        }

        .grading-scale::before {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            background: linear-gradient(
                90deg,
                #da70d6,
                #87ceeb,
                #ffc0cb,
                #dda0dd,
                #da70d6
            );
            border-radius: 20px;
            z-index: -1;
        }

        .grading-scale h3 {
            text-align: center;
            margin-bottom: 18px;
            background: linear-gradient(45deg, #da70d6, #87ceeb, #ffc0cb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.5em;
            font-weight: 800;
        }

        .grading-scale ul {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
        }

        .grading-scale li {
            text-align: center;
            padding: 15px;
            background: linear-gradient(
                45deg,
                #da70d6,
                #87ceeb,
                #ffc0cb,
                #dda0dd,
                #ffb6c1
            );
            background-size: 300% 300%;
            color: #ffffff;
            border-radius: 15px;
            font-weight: 700;
            text-shadow: 2px 2px 6px rgba(218, 112, 214, 0.6);
            transition: all 0.4s ease;
            animation: gradeItemShimmer 4s ease-in-out infinite;
        }

        @keyframes gradeItemShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .grading-scale li:hover {
            transform: translateY(-4px) scale(1.08);
            box-shadow: 0 8px 20px rgba(218, 112, 214, 0.5);
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            .grading-scale ul {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="magical-elements">
        <div class="crown">👑</div>
        <div class="castle">🏰</div>
        <div class="wand">🪄</div>
        <div class="tiara">👸</div>
    </div>
    
    <div class="container">
        <h1>💖 Cutie Grade Calculator 🌸</h1>
        <p style="text-align: center; margin-bottom: 30px; font-size: 1.2em; color: #da70d6; font-weight: 600;">🦄 Enter your adorable scores below to calculate your kawaii final grade! 🌈✨</p>
        
        <div class="weights-info">
            <h3>🌟 Cutie Grading Weights 🌟</h3>
            <p>🎀 Quiz: 30%</p>
            <p>💕 Assignment: 30%</p>
            <p>🌸 Exam: 40%</p>
        </div>

        <div class="grading-scale">
            <h3>🏆 Kawaii Grading Scale 🏆</h3>
            <ul>
                <li>🌟 A: 90-100</li>
                <li>💖 B: 80-89</li>
                <li>🌸 C: 70-79</li>
                <li>🦄 D: 60-69</li>
                <li>🌈 F: Below 60</li>
            </ul>
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="quiz">🎀 Quiz Score (0-100):</label>
                <input type="number" 
                       id="quiz" 
                       name="quiz" 
                       min="0" 
                       max="100" 
                       step="0.01" 
                       value="<?php echo htmlspecialchars($quiz_score); ?>"
                       placeholder="Enter your cutie quiz score! 💕"
                       required>
            </div>

            <div class="form-group">
                <label for="assignment">💕 Assignment Score (0-100):</label>
                <input type="number" 
                       id="assignment" 
                       name="assignment" 
                       min="0" 
                       max="100" 
                       step="0.01" 
                       value="<?php echo htmlspecialchars($assignment_score); ?>"
                       placeholder="Enter your adorable assignment score! 🌸"
                       required>
            </div>

            <div class="form-group">
                <label for="exam">🌸 Exam Score (0-100):</label>
                <input type="number" 
                       id="exam" 
                       name="exam" 
                       min="0" 
                       max="100" 
                       step="0.01" 
                       value="<?php echo htmlspecialchars($exam_score); ?>"
                       placeholder="Enter your kawaii exam score! 🦄"
                       required>
            </div>

            <button type="submit" class="submit-btn">💖 Calculate My Cutie Grade! 🌈</button>
        </form>

        <?php if (!empty($result)): ?>
            <div class="result">
                <?php echo $result; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>