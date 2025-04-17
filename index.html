<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Home - ODUDUI CENTRAL PRIMARY SCHOOL:';

require_once 'includes/header.php';

// Fetch homepage content from database
$stmt = $conn->prepare("SELECT * FROM pages WHERE slug = 'home'");
$stmt->execute();
$result = $stmt->get_result();
$page = $result->fetch_assoc();

if (!$page) {
    // Insert default content if not exists
    $defaultContent = "<h2>Welcome to ODUDUI CENTRAL PRIMARY SCHOOL:</h2>
                      <p>We provide quality education in a nurturing environment that fosters academic excellence and personal growth.</p>
                      <p>Our dedicated staff and modern facilities ensure your child receives the best possible start to their educational journey.</p>";
    
    $stmt = $conn->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
    $title = "Home";
    $slug = "home";
    $stmt->bind_param("sss", $title, $slug, $defaultContent);
    $stmt->execute();
    
    // Fetch again
    $stmt = $conn->prepare("SELECT * FROM pages WHERE slug = 'home'");
    $stmt->execute();
    $result = $stmt->get_result();
    $page = $result->fetch_assoc();
}
?>

<!-- Slideshow -->
<div class="slideshow-container">
    <div class="slide fade">
        <img src="images/tour6.jpg" alt="School Building">
        <div class="slide-caption">Our Modern School Facilities</div>
    </div>
    <div class="slide fade">
        <img src="images/slide3.jpg" alt="Students in Classroom">
        <div class="slide-caption">Engaging Learning Environment</div>
    </div>
    <div class="slide fade">
        <img src="images/slide2.png" alt="School Playground" >
        <div class="slide-caption"> Fun and Safe Play Areas </div>
    </div>
    <div class="slide fade">
        <img src="images/tour3.jpg" alt="School Building">
        <div class="slide-caption">Our Modern School Facilities</div>
    </div>
    <div class="slide fade">
        <img src="images/tour.jpg" alt="Students in Classroom">
        <div class="slide-caption">Engaging Learning Environment</div>
    </div>
    <div class="slide fade">
        <img src="images/tour4.jpg" alt="School Playground">
        <div class="slide-caption">Fun and Safe Play Areas</div>
    </div>
    <a class="prev">&#10094;</a>
    <a class="next">&#10095;</a>
</div>

<div class="dots">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>

<!-- Main Content -->
<section>
    <?php echo $page['content']; ?>
    
    <?php if (isAdminLoggedIn()): ?>
        <div class="admin-actions">
            <a href="admin/manage_content.php?edit=<?php echo $page['id']; ?>" class="btn">Edit Home Content</a>
        </div>
    <?php endif; ?>
</section>

<section class="quick-info">
    <div class="info-cards">
        <div class="info-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Quality Education</h3>
            <p>Our curriculum is designed to meet national standards while fostering creativity.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-users"></i>
            <h3>Experienced Teachers</h3>
            <p>Our staff are highly qualified and dedicated to student success.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-child"></i>
            <h3>Safe Environment</h3>
            <p>We prioritize student safety and well-being above all else.</p>
        </div>
    </div>
</section>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Welcome to ODUDUI CENTRAL PRIMARY SCHOOL:</h1>
        <p>Quality education in a nurturing environment since 1995</p>
        <a href="about.php" class="btn btn-large">Learn More About Us</a>
    </div>
</section>

<!-- Quick Links Section -->
<section class="quick-links">
    <div class="container">
        <div class="link-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Our Programs</h3>
            <p>Discover our comprehensive curriculum and extracurricular activities</p>
            <a href="about.php#programs" class="btn">View Programs</a>
        </div>
        <div class="link-card">
            <i class="fas fa-calendar-alt"></i>
            <h3>School Calendar</h3>
            <p>Stay updated with important dates and events</p>
            <a href="news.php" class="btn">View Events</a>
        </div>
        <div class="link-card">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Visit Us</h3>
            <p>Schedule a tour of our facilities</p>
            <a href="contact.php" class="btn">Contact Now</a>
        </div>
    </div>
</section>

<!-- Featured News Section -->
<section class="featured-section">
    <div class="container">
        <h2>Latest News & Announcements</h2>
        <div class="news-preview">
            <?php
            $news = $conn->query("SELECT * FROM news ORDER BY publish_date DESC LIMIT 3");
            while ($item = $news->fetch_assoc()):
            ?>
            <div class="news-item">
                <div class="news-date"><?= date('M j', strtotime($item['publish_date'])) ?></div>
                <h3><?= htmlspecialchars($item['title']) ?></h3>
                <p><?= substr(htmlspecialchars($item['content']), 0, 100) ?>...</p>
                <a href="news_detail.php?id=<?= $item['id'] ?>" class="btn btn-small">Read More</a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="section-footer">
            <a href="news.php" class="btn">View All News</a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="featured-section bg-light">
    <div class="container">
        <h2>Glimpses of School Life</h2>
        <div class="gallery-preview">
            <?php
            $gallery = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC LIMIT 6");
            while ($item = $gallery->fetch_assoc()):
            ?>
            <div class="gallery-thumbnail">
                <img src="uploads/gallery/<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                <div class="gallery-overlay">
                    <h4><?= htmlspecialchars($item['title']) ?></h4>
                    <a href="gallery.php" class="btn btn-small">View More</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="section-footer">
            <a href="gallery.php" class="btn">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <div class="container">
        <h2>What Parents Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial">
                <div class="quote">"The teachers are truly dedicated to the children's growth."</div>
                <div class="author">- Mrs. Johnson, Parent</div>
            </div>
            <div class="testimonial">
                <div class="quote">"My child has flourished academically and socially."</div>
                <div class="author">- Mr. Adebayo, Parent</div>
            </div>
        </div>
        <div class="section-footer">
            <a href="about.php#testimonials" class="btn">More Testimonials</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta">
    <div class="container">
        <h2>Ready to Join Our Community?</h2>
        <p>Admissions are open for the 2023/2024 academic session</p>
        <div class="cta-buttons">
            <a href="admissions.php" class="btn btn-primary">Apply Now</a>
            <a href="contact.php" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>