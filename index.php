<?php
function fetchMatches() {
    $date = date('Y-m-d');
    $url = "https://www.sofascore.com/api/v1/sport/football/scheduled-events/$date";
    $opts = [
        "http" => [
            "header" => "User-Agent: Mozilla/5.0\r\nAccept: application/json\r\n"
        ]
    ];
    $context = stream_context_create($opts);
    $json = @file_get_contents($url, false, $context);
    if ($json === FALSE) return null;
    $data = json_decode($json, true);
    return $data['events'] ?? [];
}
$matches = fetchMatches();
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mpingo TV - Football Matches</title>
    <link rel="icon" href="favicon.svg" type="image/svg+xml" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
      <h1><span class="logo">M</span>Mpingo TV</h1>
      <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
        <span class="material-symbols-outlined icon-light">light_mode</span>
        <span class="material-symbols-outlined icon-dark">dark_mode</span>
        <span class="theme-label">Theme</span>
      </button>
    </header>
    <main id="events-container">
      <?php if ($matches === null): ?>
        <p class="error-message">Could not load match data. The API might be temporarily unavailable.</p>
      <?php elseif (empty($matches)): ?>
        <p class="no-matches">No matches scheduled for today.</p>
      <?php else: ?>
        <?php foreach ($matches as $event):
            $leagueName = $event['tournament']['name'] ?? 'Unknown League';
            $roundNumber = isset($event['roundInfo']['round']) ? 'Round ' . $event['roundInfo']['round'] : '';
            $homeTeamName = $event['homeTeam']['name'] ?? 'Home Team';
            $awayTeamName = $event['awayTeam']['name'] ?? 'Away Team';
            $homeTeamId = $event['homeTeam']['id'] ?? null;
            $awayTeamId = $event['awayTeam']['id'] ?? null;
            $homeTeamLogo = $homeTeamId ? "https://img.sofascore.com/api/v1/team/$homeTeamId/image" : 'https://via.placeholder.com/50';
            $awayTeamLogo = $awayTeamId ? "https://img.sofascore.com/api/v1/team/$awayTeamId/image" : 'https://via.placeholder.com/50';
            $statusType = $event['status']['type'] ?? '';
            $statusDesc = $event['status']['description'] ?? '';
            $startTimestamp = $event['startTimestamp'] ?? 0;
            $matchTime = date('H:i', $startTimestamp);
        ?>
        <div class="match-card" tabindex="0" role="button" aria-label="More about this match" onclick="showDialog()" onkeydown="if(event.key==='Enter'){showDialog();}">
          <div class="match-details">
            <span><?= htmlspecialchars($leagueName) ?><?= $roundNumber ? ', ' . htmlspecialchars($roundNumber) : '' ?></span>
          </div>
          <div class="match-body">
            <div class="team home-team">
              <img src="<?= htmlspecialchars($homeTeamLogo) ?>" alt="<?= htmlspecialchars($homeTeamName) ?>" class="team-logo" onerror="this.src='https://via.placeholder.com/50';" />
              <span class="team-name"><?= htmlspecialchars($homeTeamName) ?></span>
            </div>
            <div class="match-info">
              <?php if ($statusType === 'finished'): ?>
                <div class="match-score"><?= $event['homeScore']['current'] ?? '-' ?> - <?= $event['awayScore']['current'] ?? '-' ?></div>
                <div class="match-status finished">Ended</div>
              <?php elseif ($statusType === 'postponed'): ?>
                <div class="match-time">Postponed</div>
                <div class="match-status">Postponed</div>
              <?php elseif ($statusType === 'inprogress'): ?>
                <div class="match-score"><?= $event['homeScore']['current'] ?? '-' ?> - <?= $event['awayScore']['current'] ?? '-' ?></div>
                <div class="match-status live">
                  <span class="live-indicator"></span>
                  <?= htmlspecialchars($statusDesc) ?>
                </div>
              <?php elseif ($statusType === 'notstarted'): ?>
                <div class="match-time"><?= $matchTime ?></div>
                <div class="match-status">Not started</div>
              <?php else: ?>
                <div class="match-time"><?= $matchTime ?></div>
                <div class="match-status"><?= htmlspecialchars($statusDesc) ?></div>
              <?php endif; ?>
            </div>
            <div class="team away-team">
              <img src="<?= htmlspecialchars($awayTeamLogo) ?>" alt="<?= htmlspecialchars($awayTeamName) ?>" class="team-logo" onerror="this.src='https://via.placeholder.com/50';" />
              <span class="team-name"><?= htmlspecialchars($awayTeamName) ?></span>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <!-- Modern Dialog -->
      <div id="modern-dialog" class="modern-dialog-backdrop" tabindex="-1" aria-modal="true" role="dialog" style="display:none;">
        <div class="modern-dialog">
          <button class="dialog-close" aria-label="Close dialog" onclick="closeDialog()">&times;</button>
          <div class="dialog-content">
            <h2>More about this coming soon!</h2>
            <p>We are working to bring you more details, stats, and live features for each match. Stay tuned!</p>
          </div>
          <div class="dialog-footer">
            <button class="dialog-ok" onclick="closeDialog()">OK</button>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <a href="privacy.php">Privacy Policy</a>
      <a href="terms.php">Terms of Service</a>
    </footer>
    <script>
    // Theme switcher logic
    function applyTheme(theme) {
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    }
    function setTheme(theme) {
      localStorage.setItem('theme', theme);
      applyTheme(theme);
    }
    document.addEventListener('DOMContentLoaded', function() {
      const themeToggle = document.getElementById('theme-toggle');
      const savedTheme = localStorage.getItem('theme') || 'dark';
      applyTheme(savedTheme);
      themeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(isDark ? 'light' : 'dark');
      });
    });
    // Modern dialog logic
    function showDialog() {
      document.getElementById('modern-dialog').style.display = 'flex';
      document.getElementById('modern-dialog').focus();
    }
    function closeDialog() {
      document.getElementById('modern-dialog').style.display = 'none';
    }
    // ESC key closes dialog
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeDialog();
    });
    </script>
</body>
</html> 