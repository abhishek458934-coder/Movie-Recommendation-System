<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Require login
requireLogin();

$pageTitle = 'My Watchlist';
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="page-section">
        <div class="section-header">
            <h2>My Watchlist</h2>
            <button class="preferences-btn" onclick="clearWatchlist()">
                <i class="fas fa-trash"></i> Clear All
            </button>
        </div>
        
        <div class="watchlist-content">
            <div class="loading">
                <div class="loading-spinner"></div>
                <p class="loading-text">Loading your watchlist...</p>
            </div>
        </div>
    </div>
</main>

<script>
// Set login status for JavaScript
window.userLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;

// Load watchlist on page load
document.addEventListener('DOMContentLoaded', function() {
    loadUserWatchlist();
});
</script>

<?php include 'includes/footer.php'; ?>
