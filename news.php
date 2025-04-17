<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'News & Events - Odudui Nur. & Primary School';
require_once 'includes/header.php';

// Pagination setup
$perPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Get total number of news items
$totalStmt = $conn->prepare("SELECT COUNT(*) as total FROM news");
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalNews = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalNews / $perPage);

// Fetch news items with pagination
$stmt = $conn->prepare("SELECT * FROM news ORDER BY publish_date DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $perPage, $offset);
$stmt->execute();
$news = $stmt->get_result();
?>

<section>
    <h2>News & Events</h2>
    <p>Stay updated with the latest happenings at Odudui Nur. & Primary School.</p>
    
    <?php if (isAdminLoggedIn()): ?>
        <div class="admin-actions">
            <a href="admin/manage_news.php" class="btn">Manage News</a>
            <a href="admin/manage_news.php?action=create" class="btn btn-success">Add New Item</a>
        </div>
    <?php endif; ?>
    
    <div class="news-grid">
        <?php if ($news->num_rows > 0): ?>
            <?php while ($item = $news->fetch_assoc()): ?>
                <div class="news-item">
                    <?php if ($item['image_path']): ?>
                        <img src="uploads/news/<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <?php else: ?>
                        <div class="news-placeholder">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    <?php endif; ?>
                    <div class="news-content">
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p class="news-date">
                            <i class="far fa-calendar-alt"></i> 
                            <?php echo date('F j, Y', strtotime($item['publish_date'])); ?>
                        </p>
                        <p class="news-excerpt">
                            <?php echo nl2br(htmlspecialchars(substr($item['content'], 0, 200))); ?>
                            <?php if (strlen($item['content']) > 200): ?>...<?php endif; ?>
                        </p>
                        <a href="news_detail.php?id=<?php echo $item['id']; ?>" class="btn">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-news">
                <p>No news items found. Please check back later.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="prev">&laquo; Previous</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="next">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php
require_once 'includes/footer.php';
?>