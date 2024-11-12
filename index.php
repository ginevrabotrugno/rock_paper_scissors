<?php

// Definisce le mosse e le rispettive vittorie
$values = ['rock', 'paper', 'scissors', 'lizard', 'spock'];
$winning_combinations = [
    'scissors' => ['paper', 'lizard'],
    'paper' => ['rock', 'spock'],
    'rock' => ['scissors', 'lizard'],
    'lizard' => ['spock', 'paper'],
    'spock' => ['scissors', 'rock']
];

// Controlla che l'input sia valido
if (isset($_GET['userPlay']) && in_array($_GET['userPlay'], $values)) {
    $userPlay = $_GET['userPlay'];
    $botPlayKey = array_rand($values);
    $botPlay = $values[$botPlayKey];

    // Determina il risultato
    if ($userPlay === $botPlay) {
        $result = "Draw!";
    } elseif (in_array($botPlay, $winning_combinations[$userPlay])) {
        $result = "Player 1 Won!";
    } else {
        $result = "Player 2 Won!";
    }
} else {
    echo "Errore: mossa non valida. Scegli tra: " . implode(", ", $values);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rock Paper Scissors Lizard Spock</title>
        <!-- Tailwind CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row gap-8 p-4">

            <!-- Blocco delle regole del gioco -->
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Game Rules</h2>
                <ul class="text-gray-700 text-left space-y-2">
                    <li><strong>Scissors</strong> cuts <strong>Paper</strong></li>
                    <li><strong>Paper</strong> covers <strong>Rock</strong></li>
                    <li><strong>Rock</strong> crushes <strong>Lizard</strong></li>
                    <li><strong>Lizard</strong> poisons <strong>Spock</strong></li>
                    <li><strong>Spock</strong> smashes <strong>Scissors</strong></li>
                    <li><strong>Scissors</strong> decapitates <strong>Lizard</strong></li>
                    <li><strong>Lizard</strong> eats <strong>Paper</strong></li>
                    <li><strong>Paper</strong> disproves <strong>Spock</strong></li>
                    <li><strong>Spock</strong> vaporizes <strong>Rock</strong></li>
                    <li><strong>Rock</strong> crushes <strong>Scissors</strong></li>
                </ul>
            </div>

            <!-- Blocco principale di gioco -->
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md text-center">
                <h1 class="text-2xl font-bold mb-4">Rock Paper Scissors Lizard Spock</h1>
                
                <form action="index.php" method="GET" class="mb-4">
                    <label for="userPlay" class="block text-lg font-medium mb-2">Choose your move:</label>
                    <select name="userPlay" id="userPlay" class="border rounded-lg px-3 py-2 w-full text-gray-700">
                        <?php foreach($values as $value) { ?>
                            <option value="<?php echo $value ?>" <?php echo (isset($userPlay) && $userPlay === $value) ? 'selected' : '' ?>>
                                <?php echo ucfirst($value) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Play</button>
                </form>

                <?php if (isset($userPlay) && isset($botPlay)) { ?>
                    <div class="mt-4">
                        <p class="text-gray-700 text-lg">You chose: <span class="font-semibold"><?php echo ucfirst($userPlay) ?></span></p>
                        <p class="text-gray-700 text-lg">Bot chose: <span class="font-semibold"><?php echo ucfirst($botPlay) ?></span></p>
                        <h2 class="text-xl font-bold mt-4 <?php echo $result === 'Draw!' ? 'text-yellow-500' : ($result === 'Player 1 Won!' ? 'text-green-500' : 'text-red-500'); ?>">
                            <?php echo $result ?>
                        </h2>
                    </div>
                <?php } else if (isset($result)) { ?>
                    <p class="text-red-500 font-semibold"><?php echo $result ?></p>
                <?php } ?>
            </div>
        </div>
    </body>
</html>