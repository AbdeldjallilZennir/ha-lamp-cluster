<?php
// Database Credentials
$servername = "192.168.100.59";
$username = "webuser";
$password = "LampPass123!";

// Fetch Web Node System Stats
$hostname = gethostname();
$load = sys_getloadavg();
$server_time = date("Y-m-d H:i:s");

// Initialize UI
echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
echo "<h1 style='text-align: center; color: #2c3e50;'>HA Cluster Status Dashboard</h1>";
echo "<hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>";

try {
    // Attempt Database Connection
    $conn = new mysqli($servername, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }

    // Fetch Database Stats
    $uptime_query = $conn->query("SHOW GLOBAL STATUS LIKE 'Uptime'");
    $uptime_row = $uptime_query->fetch_assoc();
    $db_uptime_seconds = $uptime_row['Value'];
    $db_uptime_formatted = gmdate("H:i:s", $db_uptime_seconds);

    $threads_query = $conn->query("SHOW STATUS LIKE 'Threads_connected'");
    $threads_row = $threads_query->fetch_assoc();
    $active_connections = $threads_row['Value'];

    // Display Web Server Status (Frontend)
    echo "<div style='display: flex; justify-content: space-between;'>";
    echo "<div style='width: 48%; padding: 15px; background: #e8f4f8; border-radius: 5px;'>";
    echo "<h3 style='margin-top: 0; color: #2980b9;'>🌐 Web Node (Frontend)</h3>";
    echo "<strong>Handling Server:</strong> " . $hostname . "<br><br>";
    echo "<strong>Server Time:</strong> " . $server_time . "<br><br>";
    echo "<strong>CPU Load (1m, 5m, 15m):</strong> " . $load[0] . ", " . $load[1] . ", " . $load[2] . "<br>";
    echo "</div>";

    // Display Database Status (Backend)
    echo "<div style='width: 48%; padding: 15px; background: #eafaf1; border-radius: 5px;'>";
    echo "<h3 style='margin-top: 0; color: #27ae60;'>🗄️ Database (Backend)</h3>";
    echo "<strong>Connection:</strong> <span style='color: green; font-weight: bold;'>ACTIVE</span><br><br>";
    echo "<strong>MySQL Uptime:</strong> " . $db_uptime_formatted . "<br><br>";
    echo "<strong>Active DB Connections:</strong> " . $active_connections . "<br>";
    echo "</div>";
    echo "</div>";

    $conn->close();

} catch (Exception $e) {
    // Display Failure State
    echo "<div style='padding: 20px; background: #fdf2f2; border: 1px solid #e74c3c; border-radius: 5px; color: #c0392b; text-align: center;'>";
    echo "<h2>⚠️ System Alert: Database Unreachable</h2>";
    echo "<strong>Error Details:</strong> " . $e->getMessage() . "<br><br>";
    echo "<strong>Reporting Node:</strong> " . $hostname;
    echo "</div>";
}

echo "</div>";
?>