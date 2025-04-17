<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Contact Us - Sunshine Primary School';
require_once 'includes/header.php';

// Initialize variables
$name = $email = $phone = $subject = $message = '';
$errors = [];
$success = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validate name
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = 'Only letters and white space allowed';
    }
    
    // Validate email
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    
    // Validate phone (optional)
    if (!empty($phone) && !preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errors['phone'] = 'Invalid phone number';
    }
    
    // Validate message
    if (empty($message)) {
        $errors['message'] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $errors['message'] = 'Message should be at least 10 characters';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // In a real application, you would:
        // 1. Save to database
        // 2. Send email notification
        
        // For this example, we'll just show a success message
        $success = true;
        
        // Clear form fields
        $name = $email = $phone = $subject = $message = '';
    }
}
?>

<section>
    <h2>Contact Us</h2>
    
    <div class="contact-info">
        <p>We'd love to hear from you! Reach out with any questions or to schedule a visit.</p>
        
        <div class="contact-methods">
            <div class="contact-method">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Address</h3>
                <p>123 School Street<br>Education City, EC 12345</p>
            </div>
            <div class="contact-method">
                <i class="fas fa-phone"></i>
                <h3>Phone</h3>
                <p>(123) 456-7890<br>Office Hours: 8am - 4pm</p>
            </div>
            <div class="contact-method">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>info@sunshineprimary.edu<br>admissions@sunshineprimary.edu</p>
            </div>
        </div>
    </div>
    
    <div class="contact-form">
        <h3>Send Us a Message</h3>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <p>Thank you for your message! We'll get back to you within 2 business days.</p>
            </div>
        <?php elseif (!empty($errors)): ?>
            <div class="alert alert-danger">
                <p>Please fix the following errors:</p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form id="contactForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="name">Your Name *</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['name']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                <?php if (isset($errors['phone'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['phone']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject *</label>
                <select id="subject" name="subject" required>
                    <option value="">Select a subject</option>
                    <option value="General Inquiry" <?php echo ($subject === 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                    <option value="Admissions" <?php echo ($subject === 'Admissions') ? 'selected' : ''; ?>>Admissions</option>
                    <option value="School Tour" <?php echo ($subject === 'School Tour') ? 'selected' : ''; ?>>School Tour</option>
                    <option value="Feedback" <?php echo ($subject === 'Feedback') ? 'selected' : ''; ?>>Feedback</option>
                    <option value="Other" <?php echo ($subject === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" required><?php echo htmlspecialchars($message); ?></textarea>
                <?php if (isset($errors['message'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['message']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Send Message</button>
            </div>
        </form>
    </div>
    
    <div class="map-container">
        <h3>Our Location</h3>
        <div class="map">
            <!-- Embedded Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d959.0923156919333!2d33.624026239702374!3d1.8540291234079025!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwNTEnMTMuMyJOIDMzwrAzNyczMi4yIkU!5e0!3m2!1sen!2sug!4v1744856113317!5m2!1sen!2sug"  width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                   
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>