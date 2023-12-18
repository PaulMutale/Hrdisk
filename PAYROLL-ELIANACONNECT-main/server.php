/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

// Decode the URL of the incoming request
$uri = isset($_SERVER["REQUEST_URI"]) ? urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) : null;

// Handling the case where REQUEST_URI is not set or empty
if (!$uri) {
    // Handle this case accordingly, for example:
    // Redirect to a default page or show an error
    exit("Invalid request");
}

// Check if the request is not for the root path ('/') and if a file exists for the requested URI
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    // Serve the requested file directly
    return false;
}

// Include the Laravel index.php file for routing and handling the request
require_once __DIR__.'/public/index.php';
