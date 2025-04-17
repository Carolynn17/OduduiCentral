<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Photo Gallery - Sunshine Primary School';
require_once 'includes/header.php';

// Fetch all gallery images from database
$stmt = $conn->prepare("SELECT * FROM gallery ORDER BY created_at DESC");
$stmt->execute();
$galleryItems = $stmt->get_result();

// Get categories for filtering (if you want to implement category filtering)
$categoryStmt = $conn->prepare("SELECT DISTINCT category FROM gallery WHERE category IS NOT NULL");
$categoryStmt->execute();
$categories = $categoryStmt->get_result();
?>

<section class="gallery-section">
    <h2>Our School Gallery</h2>
    <p>Explore moments from our school life, events, and activities through these photos.</p>
    
    <?php if (isAdminLoggedIn()): ?>
        <div class="admin-actions">
            <a href="admin/manage_gallery.php" class="btn">Manage Gallery</a>
            <a href="admin/manage_gallery.php?action=add" class="btn btn-success">Add New Image</a>
        </div>
    <?php endif; ?>
    
    <!-- Category Filter (optional) -->
    <div class="gallery-filter">
        <button class="filter-btn active" data-filter="all">All</button>
        <?php while ($cat = $categories->fetch_assoc()): ?>
            <button class="filter-btn" data-filter="<?php echo htmlspecialchars(strtolower($cat['category'])); ?>">
                <?php echo htmlspecialchars($cat['category']); ?>
            </button>
        <?php endwhile; ?>
    </div>
    
    <!-- Gallery Grid -->
    <div class="gallery-grid">
        <?php if ($galleryItems->num_rows > 0): ?>
            <?php while ($item = $galleryItems->fetch_assoc()): ?>
                <div class="gallery-item" data-category="<?php echo htmlspecialchars(strtolower($item['category'] ?? 'uncategorized')); ?>">
                    <div class="gallery-img-container">
                        <img src="uploads/gallery/<?php echo htmlspecialchars($item['image_path']); ?>" 
                             alt="<?php echo htmlspecialchars($item['title']); ?>"
                             onclick="openLightbox('<?php echo htmlspecialchars($item['image_path']); ?>', '<?php echo htmlspecialchars($item['title']); ?>')">
                        <?php if (isAdminLoggedIn()): ?>
                            <div class="gallery-admin-actions">
                                <a href="admin/manage_gallery.php?edit=<?php echo $item['id']; ?>" class="btn btn-sm">Edit</a>
                                <a href="admin/manage_gallery.php?delete=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="gallery-caption">
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <?php if (!empty($item['description'])): ?>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($item['category'])): ?>
                            <span class="gallery-category"><?php echo htmlspecialchars($item['category']); ?></span>
                        <?php endif; ?>
                        <span class="gallery-date"><?php echo date('M j, Y', strtotime($item['created_at'])); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-gallery-items">
                <p>No gallery images found.</p>
                <?php if (isAdminLoggedIn()): ?>
                    <a href="admin/manage_gallery.php?action=add" class="btn">Add Your First Image</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <span class="close-btn" onclick="closeLightbox()">&times;</span>
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="">
        <div class="lightbox-caption">
            <h3 id="lightbox-title"></h3>
            <div class="lightbox-nav">
                <button class="prev-btn" onclick="changeImage(-1)">&#10094;</button>
                <button class="next-btn" onclick="changeImage(1)">&#10095;</button>
            </div>
        </div>
    </div>
</div>

<script>
// Array to store all gallery images for lightbox navigation
const galleryImages = [
    <?php 
    $galleryItems->data_seek(0); // Reset pointer to beginning
    while ($item = $galleryItems->fetch_assoc()): 
        echo "{id: " . $item['id'] . ", src: 'uploads/gallery/" . addslashes($item['image_path']) . "', title: '" . addslashes($item['title']) . "'},";
    endwhile; 
    ?>
];
let currentImageIndex = 0;

// Filter gallery items by category
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Filter items
        document.querySelectorAll('.gallery-item').forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Lightbox functions
function openLightbox(imgSrc, title, imgId = null) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    
    // Find the index of the clicked image
    if (imgId !== null) {
        currentImageIndex = galleryImages.findIndex(img => img.id === imgId);
    } else {
        currentImageIndex = galleryImages.findIndex(img => img.src.includes(imgSrc));
    }
    
    lightboxImg.src = galleryImages[currentImageIndex].src;
    lightboxTitle.textContent = galleryImages[currentImageIndex].title;
    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function changeImage(step) {
    currentImageIndex += step;
    
    // Wrap around if at beginning or end
    if (currentImageIndex >= galleryImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = galleryImages.length - 1;
    }
    
    document.getElementById('lightbox-img').src = galleryImages[currentImageIndex].src;
    document.getElementById('lightbox-title').textContent = galleryImages[currentImageIndex].title;
}

// Close lightbox when clicking outside the image
window.addEventListener('click', function(event) {
    const lightbox = document.getElementById('lightbox');
    if (event.target === lightbox) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    const lightbox = document.getElementById('lightbox');
    if (lightbox.style.display === 'flex') {
        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrWowLeft') {
            changeImage(-1);
        } else if (event.key === 'ArrowRight') {
            changeImage(1);
        }
    }
});
</script>

<?php
require_once 'includes/footer.php';
?>