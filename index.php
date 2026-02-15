<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Home';
?>

<?php include 'includes/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <h1>All Your Entertainment in One Place</h1>
        <p>Discover personalized recommendations for movies, music, and books. Find your next favorite entertainment and build your perfect watchlist.</p>
        <div class="hero-buttons">
            <a href="movies.php" class="btn btn-primary">Explore Movies</a>
            <a href="#categories" class="btn btn-secondary">Browse Categories</a>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories animate-on-scroll">
        <h2 class="section-title animate-on-scroll">Curated Categories</h2>
        <p class="section-subtitle animate-on-scroll">Find your next favorite entertainment across all media types</p>
        
        <div class="categories-grid animate-on-scroll">
            <div class="category-card animate-on-scroll floating">
                <div class="category-icon">
                    <i class="fas fa-film"></i>
                </div>
                <h3>Movies</h3>
                <p>Discover trending, popular, and upcoming films across genres and languages</p>
                <a href="movies.php" class="btn btn-primary mt-2">Browse Movies</a>
            </div>
            
            <div class="category-card animate-on-scroll floating">
                <div class="category-icon">
                    <i class="fas fa-music"></i>
                </div>
                <h3>Music</h3>
                <p>Find your next favorite tracks with new releases, top charts, and personalized recommendations</p>
                <a href="music.php" class="btn btn-primary mt-2">Browse Music</a>
            </div>
            
            <div class="category-card animate-on-scroll floating">
                <div class="category-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h3>Books</h3>
                <p>Explore bestsellers, new releases, and curated book recommendations for every taste</p>
                <a href="books.php" class="btn btn-primary mt-2">Browse Books</a>
            </div>
        </div>
    </section>

    <?php if (isLoggedIn()): ?>
    <!-- Personalized Recommendations -->
    <section class="page-section">
        <div class="section-header">
            <h2>Recommended for You</h2>
        </div>
        
        <div class="recommendations-container">
            <!-- Movies Recommendations -->
            <div class="recommendation-section">
                <h3><i class="fas fa-film"></i> Movies You Might Like</h3>
                <div class="loading-section" data-section="recommended" data-type="movies">
                    <div class="loading">
                        <div class="loading-spinner"></div>
                        <p class="loading-text">Loading...</p>
                    </div>
                </div>
            </div>
            
            <!-- Music Recommendations -->
            <div class="recommendation-section">
                <h3><i class="fas fa-music"></i> Music You Might Like</h3>
                <div class="loading-section" data-section="recommended" data-type="music">
                    <div class="loading">
                        <div class="loading-spinner"></div>
                        <p class="loading-text">Loading...</p>
                    </div>
                </div>
            </div>
            
            <!-- Books Recommendations -->
            <div class="recommendation-section">
                <h3><i class="fas fa-book"></i> Books You Might Like</h3>
                <div class="loading-section" data-section="recommended" data-type="books">
                    <div class="loading">
                        <div class="loading-spinner"></div>
                        <p class="loading-text">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php else: ?>
    <!-- Guest User CTA -->
    <section class="page-section">
        <div class="auth-cta">
            <h2>Get Personalized Recommendations</h2>
            <p>Sign up today to receive personalized entertainment recommendations based on your preferences</p>
            <div class="cta-buttons">
                <a href="signup.php" class="btn btn-primary">Sign Up Now</a>
                <a href="login.php" class="btn btn-secondary">Already have an account?</a>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<script>
// Set login status for JavaScript
window.userLoggedIn = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;
</script>

<?php include 'includes/footer.php'; ?>
