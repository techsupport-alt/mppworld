<?php
/**
 * Authentication API Endpoint
 * Handles admin login/logout and session management
 */

// Use the SAME session configuration as your dashboard
$is_https = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', $is_https ? '1' : '0');
ini_set('session.cookie_samesite', 'Lax');

session_start([
    'cookie_lifetime' => 86400, // 1 day
    'cookie_secure' => $is_https,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax'
]);

// Set dynamic CORS headers
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    $pdo = getDatabaseConnection();
    
    switch ($method) {
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            $action = $input['action'] ?? 'login';
            
            switch ($action) {
                case 'login':
                    // Login logic
                    if (!isset($input['username']) || !isset($input['password'])) {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'message' => 'Username and password required']);
                        exit();
                    }
                    
                    $username = trim($input['username']);
                    $password = trim($input['password']);
                    
                    // Check admin credentials
                    $stmt = $pdo->prepare("SELECT id, username, password_hash, full_name, role, last_login 
                                          FROM admin_users 
                                          WHERE username = ? AND is_active = 1");
                    $stmt->execute([$username]);
                    $admin = $stmt->fetch();
                    
                    if ($admin && password_verify($password, $admin['password_hash'])) {
                        // Successful login
                        $_SESSION['admin_id'] = $admin['id'];
                        $_SESSION['admin_username'] = $admin['username'];
                        $_SESSION['admin_name'] = $admin['full_name'];
                        $_SESSION['admin_role'] = $admin['role'];
                        $_SESSION['login_time'] = time();
                        
                        // Update last login
                        $stmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
                        $stmt->execute([$admin['id']]);
                        
                        // Log login activity
                        $stmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, ip_address, user_agent) 
                                              VALUES (?, 'login', ?, ?)");
                        $stmt->execute([
                            $admin['id'],
                            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
                        ]);
                        
                        echo json_encode([
                            'success' => true,
                            'message' => 'Login successful',
                            'data' => [
                                'admin_id' => $admin['id'],
                                'username' => $admin['username'],
                                'full_name' => $admin['full_name'],
                                'role' => $admin['role'],
                                'last_login' => $admin['last_login']
                            ]
                        ]);
                    } else {
                        // Failed login
                        http_response_code(401);
                        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
                        
                        // Log failed login attempt
                        $stmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, ip_address, user_agent, details) 
                                              VALUES (NULL, 'failed_login', ?, ?, ?)");
                        $stmt->execute([
                            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
                            "Failed login attempt for username: $username"
                        ]);
                    }
                    break;
                    
                case 'check_session':
                    // Check if user is logged in
                    if (isset($_SESSION['admin_id'])) {
                        $stmt = $pdo->prepare("SELECT username, full_name, role FROM admin_users WHERE id = ?");
                        $stmt->execute([$_SESSION['admin_id']]);
                        $admin = $stmt->fetch();
                        
                        if ($admin) {
                            echo json_encode([
                                'success' => true,
                                'authenticated' => true,
                                'admin' => [
                                    'admin_id' => $_SESSION['admin_id'],
                                    'username' => $admin['username'],
                                    'full_name' => $admin['full_name'],
                                    'role' => $admin['role'],
                                    'session_time' => $_SESSION['login_time'] ?? null
                                ]
                            ]);
                        } else {
                            // Invalid session
                            session_destroy();
                            echo json_encode(['success' => false, 'message' => 'Session invalid']);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Not authenticated']);
                    }
                    break;
                    
                case 'logout':
                    // Logout
                    if (isset($_SESSION['admin_id'])) {
                        // Log logout activity
                        $stmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, ip_address, user_agent) 
                                              VALUES (?, 'logout', ?, ?)");
                        $stmt->execute([
                            $_SESSION['admin_id'],
                            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
                        ]);
                        
                        session_destroy();
                        echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
                    } else {
                        echo json_encode(['success' => true, 'message' => 'No active session']);
                    }
                    break;
                    
                default:
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Invalid action']);
                    break;
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            break;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Authentication error occurred',
        'error' => $e->getMessage()
    ]);
}
?>
