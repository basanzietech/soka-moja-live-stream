<?php
function fetchMatches() {
    $date = date('Y-m-d');
    $url = "https://www.sofascore.com/api/v1/sport/football/scheduled-events/$date";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Host: www.sofascore.com",
        "cache-control: max-age=0",
        "sec-ch-ua: \"Not)A;Brand\";v=\"99\", \"Google Chrome\";v=\"127\", \"Chromium\";v=\"127\"",
        "sec-ch-ua-mobile: ?1",
        "sec-ch-ua-platform: \"Android\"",
        "upgrade-insecure-requests: 1",
        "user-agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36",
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
        "sec-fetch-site: none",
        "sec-fetch-mode: navigate",
        "sec-fetch-user: ?1",
        "sec-fetch-dest: document"
    ]);
    $json = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($json !== FALSE && $httpCode == 200) {
        $data = json_decode($json, true);
        if ($data && isset($data['events']) && !empty($data['events'])) {
            return $data['events'];
        }
    }
    return [];
}

$matches = fetchMatches();
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- SEO Meta Tags -->
    <title>Mpingo TV - Live Football Matches, Scores & Schedules | Premier League, Champions League</title>
    <meta name="description" content="Watch live football matches, get real-time scores, and stay updated with match schedules. Premier League, Champions League, La Liga, Serie A, Bundesliga and more." />
    <meta name="keywords" content="football matches, live scores, premier league, champions league, la liga, serie a, bundesliga, live football, match schedule, football scores" />
    <meta name="author" content="Mpingo TV" />
    <meta name="robots" content="index, follow" />
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Mpingo TV - Live Football Matches & Scores" />
    <meta property="og:description" content="Watch live football matches, get real-time scores, and stay updated with match schedules." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://mpingotv.com" />
    <meta property="og:image" content="https://mpingotv.com/favicon.svg" />
    <meta property="og:site_name" content="Mpingo TV" />
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Mpingo TV - Live Football Matches & Scores" />
    <meta name="twitter:description" content="Watch live football matches, get real-time scores, and stay updated with match schedules." />
    <meta name="twitter:image" content="https://mpingotv.com/favicon.svg" />
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://mpingotv.com" />
    
    <!-- Favicon -->
    <link rel="icon" href="favicon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="favicon.svg" />
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="manifest.json" />
    
    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css" />
    
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-YOUR_PUBLISHER_ID" crossorigin="anonymous"></script>
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Mpingo TV",
        "description": "Live football matches, scores and schedules",
        "url": "https://mpingotv.com",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://mpingotv.com?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
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
    
    <!-- AdSense Banner Ad -->
    <div class="adsense-banner">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-YOUR_PUBLISHER_ID"
             data-ad-slot="YOUR_BANNER_AD_SLOT"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    
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
                <div class="match-time countdown" data-start="<?= $startTimestamp ?>"><?= $matchTime ?></div>
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
      
      <!-- AdSense In-Article Ad -->
      <div class="adsense-inarticle">
        <ins class="adsbygoogle"
             style="display:block; text-align:center;"
             data-ad-layout="in-article"
             data-ad-format="fluid"
             data-ad-client="ca-pub-YOUR_PUBLISHER_ID"
             data-ad-slot="YOUR_INARTICLE_AD_SLOT"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
      
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
    
    <!-- AdSense Footer Ad -->
    <div class="adsense-footer">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-YOUR_PUBLISHER_ID"
             data-ad-slot="YOUR_FOOTER_AD_SLOT"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    
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
    
    // Countdown timer functionality
    function updateCountdowns() {
        const countdownElements = document.querySelectorAll('.countdown');
        const now = Math.floor(Date.now() / 1000);
        
        countdownElements.forEach(element => {
            const startTime = parseInt(element.dataset.start);
            const timeLeft = startTime - now;
            
            if (timeLeft > 0) {
                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;
                
                if (hours > 0) {
                    element.textContent = `${hours}h ${minutes}m`;
                } else if (minutes > 0) {
                    element.textContent = `${minutes}m ${seconds}s`;
                } else {
                    element.textContent = `${seconds}s`;
                }
                
                // Add urgency animation when less than 10 minutes
                if (timeLeft < 600) {
                    element.classList.add('urgent');
                }
            } else {
                element.textContent = 'LIVE';
                element.classList.add('live-now');
            }
        });
    }
    
    // Enhanced animations
    function addScrollAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.match-card').forEach(card => {
            observer.observe(card);
        });
    }
    
    // Modern dialog logic
    function showDialog() {
      const dialog = document.getElementById('modern-dialog');
      dialog.style.display = 'flex';
      dialog.focus();
      dialog.classList.add('dialog-enter');
    }
    function closeDialog() {
      const dialog = document.getElementById('modern-dialog');
      dialog.classList.remove('dialog-enter');
      dialog.classList.add('dialog-exit');
      setTimeout(() => {
        dialog.style.display = 'none';
        dialog.classList.remove('dialog-exit');
      }, 300);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
      const themeToggle = document.getElementById('theme-toggle');
      const savedTheme = localStorage.getItem('theme') || 'dark';
      applyTheme(savedTheme);
      
      themeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(isDark ? 'light' : 'dark');
      });
      
      // Initialize countdown timers
      updateCountdowns();
      setInterval(updateCountdowns, 1000);
      
      // Initialize scroll animations
      addScrollAnimations();
    });
    
    // ESC key closes dialog
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeDialog();
    });
    
    // Service Worker for PWA capabilities
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => console.log('SW registered'))
                .catch(registrationError => console.log('SW registration failed'));
        });
    }
    </script>
</body>
</html> 