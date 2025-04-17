<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Check if news ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: news.php");
    exit();
}

$newsId = (int)$_GET['id'];

// Fetch the news item
$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $newsId);
$stmt->execute();
$result = $stmt->get_result();
$newsItem = $result->fetch_assoc();

if (!$newsItem) {
    header("Location: news.php");
    exit();
}

$pageTitle = htmlspecialchars($newsItem['title']) . ' - Sunshine Primary School';
require_once 'includes/header.php';
?>

<section>
    <div class="news-detail">
        <h2><?php echo htmlspecialchars($newsItem['title']); ?></h2>
        
        <div class="news-meta">
            <span class="news-date">
                <i class="far fa-calendar-alt"></i> 
                <?php echo date('F j, Y', strtotime($newsItem['publish_date'])); ?>
            </span>
            
            <?php if (isAdminLoggedIn()): ?>
                <span class="news-actions">
                    <a href="admin/manage_news.php?edit=<?php echo $newsItem['id']; ?>" class="btn btn-sm">Edit</a>
                    <a href="admin/manage_news.php?delete=<?php echo $newsItem['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
                </span>
            <?php endif; ?>
        </div>
        
        <?php if ($newsItem['image_path']): ?>
            <div class="news-image">
                <img src="uploads/news/<?php echo htmlspecialchars($newsItem['image_path']); ?>" alt="<?php echo htmlspecialchars($newsItem['title']); ?>">
            </div>
        <?php endif; ?>
        
        <div class="news-content">
            <?php echo nl2br(htmlspecialchars($newsItem['content'])); ?>
        </div>
        
        <div class="news-navigation">
            <a href="news.php" class="btn">
                <i class="fas fa-arrow-left"></i> Back to News
            </a>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>