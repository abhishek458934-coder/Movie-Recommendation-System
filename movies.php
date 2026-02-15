<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Movies';
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="page-section">
        <div class="section-header">
            <h2>Movies</h2>
            <?php if (isLoggedIn()): ?>
                <button class="preferences-btn" onclick="showPreferences('movie')">
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
                        <option value="action" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'action' ? 'selected' : ''; ?>>Action</option>
                        <option value="comedy" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'comedy' ? 'selected' : ''; ?>>Comedy</option>
                        <option value="drama" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'drama' ? 'selected' : ''; ?>>Drama</option>
                        <option value="horror" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'horror' ? 'selected' : ''; ?>>Horror</option>
                        <option value="romance" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'romance' ? 'selected' : ''; ?>>Romance</option>
                        <option value="sci-fi" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'sci-fi' ? 'selected' : ''; ?>>Sci-Fi</option>
                        <option value="thriller" <?php echo isset($_GET['genre']) && $_GET['genre'] === 'thriller' ? 'selected' : ''; ?>>Thriller</option>
                    </select>
                    
                    <select name="year" class="filter-select">
                        <option value="">Any Year</option>
                        <option value="2024" <?php echo isset($_GET['year']) && $_GET['year'] === '2024' ? 'selected' : ''; ?>>2024</option>
                        <option value="2023" <?php echo isset($_GET['year']) && $_GET['year'] === '2023' ? 'selected' : ''; ?>>2023</option>
                        <option value="2022" <?php echo isset($_GET['year']) && $_GET['year'] === '2022' ? 'selected' : ''; ?>>2022</option>
                        <option value="2021" <?php echo isset($_GET['year']) && $_GET['year'] === '2021' ? 'selected' : ''; ?>>2021</option>
                        <option value="2020" <?php echo isset($_GET['year']) && $_GET['year'] === '2020' ? 'selected' : ''; ?>>2020</option>
                    </select>
                    
                    <select name="sort" class="filter-select">
                        <option value="popular" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'popular' ? 'selected' : ''; ?>>Most Popular</option>
                        <option value="recent" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'recent' ? 'selected' : ''; ?>>Most Recent</option>
                        <option value="rating" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'rating' ? 'selected' : ''; ?>>Highest Rated</option>
                    </select>
                </div>
            </form>
        </div>
        
        <!-- Upcoming Movies -->
        <div class="movie-section">
            <h3><i class="fas fa-calendar-alt"></i> Upcoming Movies</h3>
            <div class="loading-section" data-section="upcoming" data-type="movies">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <!-- Popular Movies -->
        <div class="movie-section">
            <h3><i class="fas fa-fire"></i> Popular Movies</h3>
            <div class="loading-section" data-section="popular" data-type="movies">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <?php if (isLoggedIn()): ?>
        <!-- Recommended Movies -->
        <div class="movie-section">
            <h3><i class="fas fa-star"></i> Recommended for You</h3>
            <div class="loading-section" data-section="recommended" data-type="movies">
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
            // Reload page with new filters
            this.form.submit();
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
