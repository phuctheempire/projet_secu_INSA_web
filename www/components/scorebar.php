<?php
$file = "/home/xpham/Downloads/projet_secu_INSA_web-deelong/scores.txt";
$max = 100;

$currentScore = null;
// Read the file line by line
foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    // Check if the line starts with "Current Score"
    if (strpos($line, "Current Score:") === 0) {
        // Extract the value after "Current Score:"
        $currentScore = intval(trim(str_replace("Current Score:", "", $line)));
        break; // Exit the loop once the score is found
    }
}
$percentage = $currentScore/$max * 100;

?>
<div style="width: 100%; background-color: #e0e0e0; height: 20px; border-radius: 10px; overflow: hidden;">
        <div style="height: 100%; background-color: #4caf50; width: <?= $percentage; ?>%; text-align: center; color: white; line-height: 20px; font-size: 14px;">
            <?= round($percentage, 2); ?>%
        </div>
    </div>
</div>