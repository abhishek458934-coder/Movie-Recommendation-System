<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

$pageTitle = 'Login';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    
    // Admin login check
    if ($email === 'AAVC@gmail.com' && $password === '123456') {
        $_SESSION['user_id'] = 'admin';
        $_SESSION['username'] = 'AAVC';
        $_SESSION['is_admin'] = true;
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
        header('Location: ' . $redirect);
        exit();
    }
    
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        require_once 'includes/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        
        try {
            $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = false;
                // Redirect to intended page or home
                $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
                header('Location: ' . $redirect);
                exit();
            } else {
                $error = 'Invalid email or password';
            }
        } catch (PDOException $e) {
            $error = 'Login failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . ' - ' . SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your MediaRecs account</p>
                <div class="auth-toggle">
                    <span class="toggle-option active" data-form="login">Login</span>
                    <span class="toggle-divider">|</span>
                    <span class="toggle-option" data-form="signup">Sign Up</span>
                </div>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="error-message" style="background-color: #ff000020; color: #ff6b6b; padding: 1rem; border-radius: 5px; margin-bottom: 1rem; text-align: center;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <!-- Login Form -->
            <form method="POST" class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>
                
                <button type="submit" class="form-submit">Sign In</button>
            </form>
            
            <!-- Signup Form -->
            <form method="POST" action="signup.php" class="auth-form hidden" id="signupForm">
                <div class="form-group">
                    <label for="signup_username" class="form-label">Username</label>
                    <input type="text" id="signup_username" name="username" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="signup_email" class="form-label">Email Address</label>
                    <input type="email" id="signup_email" name="email" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="signup_password" class="form-label">Password</label>
                    <input type="password" id="signup_password" name="password" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-input" required>
                </div>
                
                <button type="submit" class="form-submit">Create Account</button>
            </form>
            
            <div class="auth-footer">
                <p><a href="index.php">← Back to Home</a></p>
            </div>
        </div>
    </div>
    
    <script src="assets/js/main.js"></script>
    <script>
        // Toggle between login and signup forms
        document.addEventListener('DOMContentLoaded', function() {
            const toggleOptions = document.querySelectorAll('.toggle-option');
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const authHeader = document.querySelector('.auth-header h1');
            const authSubtext = document.querySelector('.auth-header p');
            
            toggleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const formType = this.dataset.form;
                    
                    // Update active state
                    toggleOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show/hide forms
                    if (formType === 'login') {
                        loginForm.classList.remove('hidden');
                        signupForm.classList.add('hidden');
                        authHeader.textContent = 'Welcome Back';
                        authSubtext.textContent = 'Sign in to your MediaRecs account';
                    } else {
                        loginForm.classList.add('hidden');
                        signupForm.classList.remove('hidden');
                        authHeader.textContent = 'Join MediaRecs';
                        authSubtext.textContent = 'Create your account to get personalized recommendations';
                    }
                });
            });
        });
    </script>
</body>
</html>
