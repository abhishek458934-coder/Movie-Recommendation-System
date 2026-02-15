<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Search Results';
$query = isset($_GET['q']) ? sanitizeInput($_GET['q']) : '';
$type = isset($_GET['type']) ? sanitizeInput($_GET['type']) : 'all';
$genre = isset($_GET['genre']) ? sanitizeInput($_GET['genre']) : '';
$year = isset($_GET['year']) ? sanitizeInput($_GET['year']) : '';
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="page-section">
        <div class="section-header">
            <h2>Search Results</h2>
            <?php if (!empty($query)): ?>
                <p>Showing results for: "<strong><?php echo htmlspecialchars($query); ?></strong>"</p>
            <?php endif; ?>
        </div>
        
        <!-- Advanced Filters -->
        <div class="filters">
            <form class="search-filters-form" method="GET">
                <input type="hidden" name="q" value="<?php echo htmlspecialchars($query); ?>">
                <div class="filter-group">
                    <select name="type" class="filter-select">
                        <option value="all" <?php echo $type === 'all' ? 'selected' : ''; ?>>All Types</option>
                        <option value="movie" <?php echo $type === 'movie' ? 'selected' : ''; ?>>Movies</option>
                        <option value="music" <?php echo $type === 'music' ? 'selected' : ''; ?>>Music</option>
                        <option value="book" <?php echo $type === 'book' ? 'selected' : ''; ?>>Books</option>
                    </select>
                    
                    <select name="genre" class="filter-select">
                        <option value="">Any Genre</option>
                        <option value="action" <?php echo $genre === 'action' ? 'selected' : ''; ?>>Action</option>
                        <option value="comedy" <?php echo $genre === 'comedy' ? 'selected' : ''; ?>>Comedy</option>
                        <option value="drama" <?php echo $genre === 'drama' ? 'selected' : ''; ?>>Drama</option>
                        <option value="horror" <?php echo $genre === 'horror' ? 'selected' : ''; ?>>Horror</option>
                        <option value="romance" <?php echo $genre === 'romance' ? 'selected' : ''; ?>>Romance</option>
                        <option value="sci-fi" <?php echo $genre === 'sci-fi' ? 'selected' : ''; ?>>Sci-Fi</option>
                        <option value="thriller" <?php echo $genre === 'thriller' ? 'selected' : ''; ?>>Thriller</option>
                    </select>
                    
                    <select name="year" class="filter-select">
                        <option value="">Any Year</option>
                        <option value="2024" <?php echo $year === '2024' ? 'selected' : ''; ?>>2024</option>
                        <option value="2023" <?php echo $year === '2023' ? 'selected' : ''; ?>>2023</option>
                        <option value="2022" <?php echo $year === '2022' ? 'selected' : ''; ?>>2022</option>
                        <option value="2021" <?php echo $year === '2021' ? 'selected' : ''; ?>>2021</option>
                        <option value="2020" <?php echo $year === '2020' ? 'selected' : ''; ?>>2020</option>
                    </select>
                </div>
            </form>
        </div>
        
        <!-- Search Results -->
        <div class="search-results">
            <?php if (empty($query)): ?>
                <div class="no-search">
                    <i class="fas fa-search no-search-icon"></i>
                    <h3>Start Your Search</h3>
                    <p>Enter a search term to find movies, music, and books</p>
                </div>
            <?php else: ?>
                <div class="loading">
                    <div class="loading-spinner"></div>
                    <p class="loading-text">Searching...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
// Set login status for JavaScript
window.userLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;

// Initialize search functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeSearchFilters();
    
    <?php if (!empty($query)): ?>
        performSearch();
    <?php endif; ?>
});
</script>

<?php include 'includes/footer.php'; ?>
