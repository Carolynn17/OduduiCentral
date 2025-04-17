<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'About Us - Sunshine Primary School';
require_once 'includes/header.php';

// Fetch about page content from database or create default
$page = getPageBySlug('about');

if (!$page) {
    $defaultContent = <<<HTML
    <section class="about-intro">
        <h2>Welcome to Sunshine Primary School</h2>
        <p>Founded in 1995, Sunshine Primary School has been providing quality education to children in our community for over 25 years. We pride ourselves on creating a nurturing environment that fosters academic excellence, creativity, and personal growth.</p>
        
        <div class="mission-vision">
            <div class="mission">
                <h3><i class="fas fa-bullseye"></i> Our Mission</h3>
                <p>To nurture young minds through a balanced approach to academic excellence, character development, and creative expression.</p>
            </div>
            <div class="vision">
                <h3><i class="fas fa-eye"></i> Our Vision</h3>
                <p>To be a leading primary school that prepares students to be lifelong learners and responsible global citizens.</p>
            </div>
        </div>
    </section>
    
    <section class="core-values">
        <h3>Our Core Values</h3>
        <div class="values-grid">
            <div class="value-card">
                <i class="fas fa-heart"></i>
                <h4>Respect</h4>
                <p>We value each individual and treat everyone with kindness and consideration.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-star"></i>
                <h4>Excellence</h4>
                <p>We strive for the highest standards in all we do.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-handshake"></i>
                <h4>Integrity</h4>
                <p>We act with honesty and strong moral principles.</p>
            </div>
            <div class="value-card">
                <i class="fas fa-lightbulb"></i>
                <h4>Creativity</h4>
                <p>We encourage innovative thinking and problem-solving.</p>
            </div>
        </div>
    </section>
    
    <section class="school-history">
        <h3>Our History</h3>
        <div class="timeline">
            <div class="timeline-event">
                <div class="event-date">1995</div>
                <div class="event-content">
                    <h4>School Founded</h4>
                    <p>Sunshine Primary School opened its doors with just 50 students and 3 teachers.</p>
                </div>
            </div>
            <div class="timeline-event">
                <div class="event-date">2002</div>
                <div class="event-content">
                    <h4>New Building</h4>
                    <p>We moved to our current location with expanded facilities.</p>
                </div>
            </div>
            <div class="timeline-event">
                <div class="event-date">2010</div>
                <div class="event-content">
                    <h4>ICT Center</h4>
                    <p>Established our computer lab and technology program.</p>
                </div>
            </div>
            <div class="timeline-event">
                <div class="event-date">2020</div>
                <div class="event-content">
                    <h4>25th Anniversary</h4>
                    <p>Celebrated 25 years of educational excellence.</p>
                </div>
            </div>
        </div>
    </section>
HTML;

    // Save default content to database
    $stmt = $conn->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
    $title = "About Us";
    $slug = "about";
    $stmt->bind_param("sss", $title, $slug, $defaultContent);
    $stmt->execute();
    
    // Fetch the newly created page
    $page = getPageBySlug('about');
}
?>

<div class="about-page">
    <?php echo $page['content']; ?>
    
    <section class="staff-section">
        <h2>Meet Our Team</h2>
        <div class="staff-grid">
            <div class="staff-member">
                <img src="images/teacher1.jpg" alt="Principal" class="staff-photo">
                <h3>Mr. Emolu Johnson</h3>
                <p>Principal</p>
                <div class="staff-bio">
                    <p>With over 20 years of educational experience, Mr. Johnson leads our school with vision and dedication.</p>
                </div>
            </div>
            
            <div class="staff-member">
                <img src="images/teacher1.jpg" alt="Deputy Principal" class="staff-photo">
                <h3>Mrs. Sarah Williams</h3>
                <p>Deputy Principal</p>
                <div class="staff-bio">
                    <p>Specializing in curriculum development, Mrs. Williams ensures our academic programs remain cutting-edge.</p>
                </div>
            </div>
            
            <div class="staff-member">
                <img src="images/teacher1.jpg" alt="Senior Teacher" class="staff-photo">
                <h3>Mr. David Brown</h3>
                <p>Head of Junior School</p>
                <div class="staff-bio">
                    <p>Mr. Brown creates engaging learning environments for our youngest students.</p>
                </div>
            </div>
            
            <div class="staff-member">
                <img src="images/teacher1.jpg" alt="Teacher" class="staff-photo">
                <h3>Ms. Emily Chen</h3>
                <p>Head of Mathematics</p>
                <div class="staff-bio">
                    <p>Ms. Chen makes math fun and accessible for all students.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="facilities">
        <h2>Our Facilities</h2>
        <div class="facilities-grid">
            <div class="facility-card">
                <img src="images/library.jpg" alt="School Library">
                <h3>Modern Library</h3>
                <p>Our fully-stocked library encourages a love of reading with over 10,000 books.</p>
            </div>
            <div class="facility-card">
                <img src="images/lab.jpg" alt="Science Lab">
                <h3>Science Laboratory</h3>
                <p>Hands-on learning in our well-equipped science lab.</p>
            </div>
            <div class="facility-card">
                <img src="images/playground.jpg" alt="Playground">
                <h3>Play Areas</h3>
                <p>Safe, modern playgrounds for physical development and fun.</p>
            </div>
        </div>
    </section>
    
    <?php if (isAdminLoggedIn()): ?>
        <div class="admin-actions">
            <a href="admin/manage_content.php?edit=<?php echo $page['id']; ?>" class="btn">Edit About Page</a>
        </div>
    <?php endif; ?>
</div>

<?php
require_once 'includes/footer.php';
?>