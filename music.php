<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Music';
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="page-section">
        <div class="section-header">
            <h2>Music</h2>
            <?php if (isLoggedIn()): ?>
                <button class="preferences-btn" onclick="showPreferences('music')">
                    <i class="fas fa-cog"></i> Preferences
                </button>
            <?php endif; ?>
        </div>
        
        <!-- Filters -->
        <div class="filters">
            <form class="search-filters-form" method="GET">
                <div class="filter-group">
                    <select name="genre" class="filter-select">
                        <option value="">All Genres</option>
                        <option value="pop" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'pop' ? 'selected' : ''; ?>>Pop</option>
                        <option value="rock" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'rock' ? 'selected' : ''; ?>>Rock</option>
                        <option value="hip-hop" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'hip-hop' ? 'selected' : ''; ?>>Hip-Hop</option>
                        <option value="jazz" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'jazz' ? 'selected' : ''; ?>>Jazz</option>
                        <option value="classical" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'classical' ? 'selected' : ''; ?>>Classical</option>
                        <option value="electronic" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'electronic' ? 'selected' : ''; ?>>Electronic</option>
                        <option value="country" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'country' ? 'selected' : ''; ?>>Country</option>
                    </select>
                    
                    <select name="type" class="filter-select">
                        <option value="album" <?php echo isset($_GET['type']) && $_GET['type'] === 'album' ? 'selected' : ''; ?>>Albums</option>
                        <option value="track" <?php echo isset($_GET['type']) && $_GET['type'] === 'track' ? 'selected' : ''; ?>>Tracks</option>
                        <option value="playlist" <?php echo isset($_GET['type']) && $_GET['type'] === 'playlist' ? 'selected' : ''; ?>>Playlists</option>
                    </select>
                    
                    <select name="sort" class="filter-select">
                        <option value="popular" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'popular' ? 'selected' : ''; ?>>Most Popular</option>
                        <option value="recent" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'recent' ? 'selected' : ''; ?>>New Releases</option>
                        <option value="trending" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'trending' ? 'selected' : ''; ?>>Trending</option>
                    </select>
                </div>
            </form>
        </div>
        
        <!-- New Releases -->
        <div class="music-section">
            <h3><i class="fas fa-compact-disc"></i> New Releases</h3>
            <div class="loading-section" data-section="new-releases" data-type="music">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <!-- Top Charts -->
        <div class="music-section">
            <h3><i class="fas fa-chart-line"></i> Top Charts</h3>
            <div class="loading-section" data-section="top-charts" data-type="music">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <!-- Featured Playlists -->
        <div class="music-section">
            <h3><i class="fas fa-list"></i> Featured Playlists</h3>
            <div class="loading-section" data-section="featured-playlists" data-type="music">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <?php if (isLoggedIn()): ?>
        <!-- Recommended Music -->
        <div class="music-section">
            <h3><i class="fas fa-star"></i> Recommended for You</h3>
            <div class="loading-section" data-section="recommended" data-type="music">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<script>
// Set login status for JavaScript
window.userLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;
window.isAdmin = <?php echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'true' : 'false'; ?>;
var isAdmin = window.isAdmin;

// Filter change handler
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('.filter-select');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
