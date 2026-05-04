<?php
$hostname = gethostname();
$timestamp = date('Y-m-d H:i:s');
$serverIp = $_SERVER['SERVER_ADDR'] ?? 'unknown';
$gitBranch = 'main';
$deployVersion = 'v1.0.' . date('Ymd');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HA Cluster — Deploy Check</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    background: #0d1117;
    color: #e6edf3;
    font-family: 'Courier New', monospace;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .card {
    background: #161b22;
    border: 1px solid #30363d;
    border-radius: 10px;
    padding: 40px;
    width: 520px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
  }
  .badge {
    display: inline-block;
    background: #238636;
    color: #fff;
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 20px;
    margin-bottom: 18px;
    letter-spacing: 1px;
  }
  h1 {
    font-size: 20px;
    color: #58a6ff;
    margin-bottom: 6px;
  }
  .sub {
    color: #8b949e;
    font-size: 12px;
    margin-bottom: 28px;
  }
  .row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #21262d;
    font-size: 13px;
  }
  .row:last-child { border-bottom: none; }
  .label { color: #8b949e; }
  .value { color: #e6edf3; font-weight: bold; }
  .value.green { color: #3fb950; }
  .value.blue  { color: #58a6ff; }
  .value.teal  { color: #39d353; }
  .footer {
    margin-top: 24px;
    text-align: center;
    font-size: 11px;
    color: #484f58;
  }
</style>
</head>
<body>
<div class="card">
  <div class="badge">✓ DEPLOYED VIA CI/CD</div>
  <h1>HA Cluster — Deploy Check</h1>
  <p class="sub">GitHub Actions → Self-Hosted Runner → SCP → Apache</p>

  <div class="row">
    <span class="label">Node</span>
    <span class="value blue"><?= htmlspecialchars($hostname) ?></span>
  </div>
  <div class="row">
    <span class="label">Server IP</span>
    <span class="value"><?= htmlspecialchars($serverIp) ?></span>
  </div>
  <div class="row">
    <span class="label">Branch</span>
    <span class="value teal"><?= $gitBranch ?></span>
  </div>
  <div class="row">
    <span class="label">Version</span>
    <span class="value"><?= $deployVersion ?></span>
  </div>
  <div class="row">
    <span class="label">Deploy Time</span>
    <span class="value"><?= $timestamp ?></span>
  </div>
  <div class="row">
    <span class="label">Status</span>
    <span class="value green">● LIVE</span>
  </div>

  <div class="footer">Zennir Abdeldjallil · Tafat Abderrahim — ESI-SBA 2025/2026</div>
</div>
</body>
</html>