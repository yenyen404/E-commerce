# E-commerce
Bootstrap e-commerce with a home page, displayed product, and admin to upload and update your products.
-DOWNLOAD BOOTSTRAP FIRST!!
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Quiz Game</title>
</head>
<body>

<h2>Enter Username</h2>

<form action="start.php" method="POST">
    <input type="text" name="username" required>
    <button type="submit">Start Game</button>
</form>

</body>
</html>

<?php
session_start();
include "db.php";

$_SESSION['username'] = $_POST['username'];
$_SESSION['score'] = 0;
$_SESSION['start_time'] = time();

// Get random question
$query = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 1");
$question = $query->fetch_assoc();

// Shuffle options
$options = [
    $question['option1'],
    $question['option2'],
    $question['option3'],
    $question['option4']
];

shuffle($options);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Game</title>
</head>
<body>

<h3><?php echo $question['question']; ?></h3>

<img src="images/<?php echo $question['image']; ?>" width="200"><br><br>

<form action="check.php" method="POST">
    <?php
    foreach ($options as $opt) {
        echo "<input type='radio' name='answer' value='$opt' required> $opt <br>";
    }
    ?>
    <input type="hidden" name="correct" value="<?php echo $question['answer']; ?>">
    <input type="hidden" name="game_id" value="<?php echo $question['game_id']; ?>">
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html><?php
session_start();
include "db.php";

$_SESSION['username'] = $_POST['username'];
$_SESSION['score'] = 0;
$_SESSION['start_time'] = time();

// Get random question
$query = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 1");
$question = $query->fetch_assoc();

// Shuffle options
$options = [
    $question['option1'],
    $question['option2'],
    $question['option3'],
    $question['option4']
];

shuffle($options);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Game</title>
</head>
<body>

<h3><?php echo $question['question']; ?></h3>

<img src="images/<?php echo $question['image']; ?>" width="200"><br><br>

<form action="check.php" method="POST">
    <?php
    foreach ($options as $opt) {
        echo "<input type='radio' name='answer' value='$opt' required> $opt <br>";
    }
    ?>
    <input type="hidden" name="correct" value="<?php echo $question['answer']; ?>">
    <input type="hidden" name="game_id" value="<?php echo $question['game_id']; ?>">
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>

<?php
session_start();
include "db.php";

$username = $_SESSION['username'];
$selected = $_POST['answer'];
$correct = $_POST['correct'];
$game_id = $_POST['game_id'];

if ($selected == $correct) {
    $_SESSION['score'] += 1;
}

$end_time = time();
$time_taken = $end_time - $_SESSION['start_time'];
$score = $_SESSION['score'];

// Save record
$stmt = $conn->prepare("INSERT INTO records (game_id, username, date, score, time) VALUES (?, ?, NOW(), ?, ?)");
$stmt->bind_param("isii", $game_id, $username, $score, $time_taken);
$stmt->execute();

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
</head>
<body>

<h2>Game Over!</h2>
<p>Username: <?php echo $username; ?></p>
<p>Score: <?php echo $score; ?></p>
<p>Time: <?php echo $time_taken; ?> seconds</p>

<a href="index.php">Play Again</a>

</body>
</html>

