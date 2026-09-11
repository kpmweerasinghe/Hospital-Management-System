<?php
/**
 * Renders a styled confirmation/error page for action scripts.
 * Purely presentational — does not alter any logic or data.
 *
 * @param string $status  'success' or 'error'
 * @param string $heading short heading text
 * @param string $message optional message/body text (already-built string, printed as-is)
 * @param array  $links   [ 'href' => 'Label', ... ]
 */
if (!function_exists('render_response')) {
function render_response($status, $heading, $message = '', $links = [])
{
    $icon = $status === 'success' ? '&#10003;' : '&#10007;';
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viweka Hospital</title>
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
<div class="response-page">
    <div class="response-card <?php echo htmlspecialchars($status); ?>">
        <div class="response-icon"><?php echo $icon; ?></div>
        <h2><?php echo $heading; ?></h2>
        <?php if ($message !== '') { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>
        <div class="response-links">
            <?php foreach ($links as $href => $label) { ?>
                <a class="btn" href="<?php echo $href; ?>"><?php echo $label; ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
    <?php
}
}
