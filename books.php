<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Books';
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="page-section">
        <div class="section-header">
            <h2>Books</h2>
            <?php if (isLoggedIn()): ?>
                <button class="preferences-btn" onclick="showPreferences('book')">
                    <i class="fas fa-cog"></i> Preferences
                </button>
            <?php endif; ?>
        </div>
        
        <!-- Filters -->
        <div class="filters">
            <form class="search-filters-form" method="GET">
                <div class="filter-group">
                    <select name="category" class="filter-select">
                        <option value="">All Categories</option>
                        <option value="fiction" <?php echo isset($_GET['category']) && $_GET['category'] === 'fiction' ? 'selected' : ''; ?>>Fiction</option>
                        <option value="biography" <?php echo isset($_GET['category']) && $_GET['category'] === 'biography' ? 'selected' : ''; ?>>Biography</option>
                        <option value="history" <?php echo isset($_GET['category']) && $_GET['category'] === 'history' ? 'selected' : ''; ?>>History</option>
                        <option value="science" <?php echo isset($_GET['category']) && $_GET['category'] === 'science' ? 'selected' : ''; ?>>Science</option>
                        <option value="self-help" <?php echo isset($_GET['category']) && $_GET['category'] === 'self-help' ? 'selected' : ''; ?>>Self Help</option>
                        <option value="mystery" <?php echo isset($_GET['category']) && $_GET['category'] === 'mystery' ? 'selected' : ''; ?>>Mystery</option>
                        <option value="romance" <?php echo isset($_GET['category']) && $_GET['category'] === 'romance' ? 'selected' : ''; ?>>Romance</option>
                    </select>
                    
                    <select name="sort" class="filter-select">
                        <option value="relevance" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'relevance' ? 'selected' : ''; ?>>Most Relevant</option>
                        <option value="newest" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'selected' : ''; ?>>Newest</option>
                        <option value="rating" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'rating' ? 'selected' : ''; ?>>Highest Rated</option>
                    </select>
                    
                    <select name="language" class="filter-select">
                        <option value="">Any Language</option>
                        <option value="en" <?php echo isset($_GET['language']) && $_GET['language'] === 'en' ? 'selected' : ''; ?>>English</option>
                        <option value="es" <?php echo isset($_GET['language']) && $_GET['language'] === 'es' ? 'selected' : ''; ?>>Spanish</option>
                        <option value="fr" <?php echo isset($_GET['language']) && $_GET['language'] === 'fr' ? 'selected' : ''; ?>>French</option>
                        <option value="de" <?php echo isset($_GET['language']) && $_GET['language'] === 'de' ? 'selected' : ''; ?>>German</option>
                    </select>
                </div>
            </form>
        </div>
        
        <!-- Bestsellers -->
        <div class="books-section">
            <h3><i class="fas fa-crown"></i> Bestsellers</h3>
            <div class="loading-section" data-section="bestsellers" data-type="books">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <!-- New Releases -->
        <div class="books-section">
            <h3><i class="fas fa-calendar-plus"></i> New Releases</h3>
            <div class="loading-section" data-section="new-releases" data-type="books">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <!-- Editor's Choice -->
        <div class="books-section">
            <h3><i class="fas fa-award"></i> Editor's Choice</h3>
            <div class="loading-section" data-section="editors-choice" data-type="books">
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Loading...</p>
                </div>
            </div>
        </div>
        
        <?php if (isLoggedIn()): ?>
        <!-- Recommended Books -->
        <div class="books-section">
            <h3><i class="fas fa-star"></i> Recommended for You</h3>
            <div class="loading-section" data-section="recommended" data-type="books">
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
