<?php
/**
 * PT. Nifara Coal Trading
 * Authentication & Security Helper Functions
 */

if (session_status() === PHP_SESSION_NONE) {
    // Configure secure session cookie attributes
    $isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
               (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_strict_mode', '1');
    
    session_start();
}

/**
 * Check if current user is authenticated as Admin
 *
 * @return bool
 */
function isAdminLoggedIn(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require admin authentication or redirect to login page
 */
function requireAdminAuth() {
    if (!isAdminLoggedIn()) {
        header("Location: index.php?msg=need_login");
        exit;
    }
}

/**
 * Generate CSRF Token for form security
 *
 * @return string
 */
function generateCSRFToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF Token
 *
 * @param string $token
 * @return bool
 */
function verifyCSRFToken(?string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
}

/**
 * Clean & sanitize text input
 *
 * @param string $data
 * @return string
 */
function sanitizeInput(string $data): string {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize Article HTML Content (XSS Prevention Allowlist)
 *
 * @param string $html
 * @return string
 */
function sanitizeArticleHtml(string $html): string {
    if (trim($html) === '') {
        return '';
    }

    $allowedTags = [
        'p', 'br', 'b', 'strong', 'i', 'em', 'u', 's', 'strike',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'ul', 'ol', 'li', 'blockquote', 'hr',
        'a', 'img', 'table', 'thead', 'tbody', 'tr', 'th', 'td',
        'span', 'div', 'figure', 'figcaption', 'code', 'pre'
    ];

    $allowedAttributes = [
        'a' => ['href', 'title', 'target', 'rel', 'class'],
        'img' => ['src', 'alt', 'title', 'width', 'height', 'loading', 'class'],
        'th' => ['scope', 'colspan', 'rowspan', 'class'],
        'td' => ['colspan', 'rowspan', 'class'],
        'span' => ['class'],
        'div' => ['class'],
        'p' => ['class'],
        'h1' => ['class'],
        'h2' => ['class'],
        'h3' => ['class'],
        'h4' => ['class'],
        'figure' => ['class'],
        'figcaption' => ['class'],
        'blockquote' => ['class'],
    ];

    if (!class_exists('DOMDocument')) {
        return strip_tags($html, '<p><br><b><strong><i><em><u><h2><h3><h4><ul><ol><li><blockquote><a><img>');
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    // Use meta charset wrapper to ensure clean UTF-8 handling across all PHP versions without deprecation
    $dom->loadHTML('<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div id="_nifara_article_root_">' . $html . '</div></body></html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $root = $dom->getElementById('_nifara_article_root_');
    if (!$root) {
        return strip_tags($html, '<p><br><b><strong><i><em><u><h2><h3><h4><ul><ol><li><blockquote><a><img>');
    }

    $cleanNode = function(DOMNode $node) use (&$cleanNode, $allowedTags, $allowedAttributes) {
        if ($node->nodeType === XML_ELEMENT_NODE) {
            $tag = strtolower($node->nodeName);
            if (!in_array($tag, $allowedTags, true)) {
                $removeEntirely = in_array($tag, ['script', 'style', 'iframe', 'object', 'embed', 'applet', 'meta', 'link', 'svg', 'math', 'form', 'input', 'button'], true);
                $parent = $node->parentNode;
                if ($parent) {
                    if ($removeEntirely) {
                        $parent->removeChild($node);
                        return;
                    } else {
                        while ($node->firstChild) {
                            $parent->insertBefore($node->firstChild, $node);
                        }
                        $parent->removeChild($node);
                        return;
                    }
                }
            }

            // Clean attributes
            $allowedForTag = $allowedAttributes[$tag] ?? [];
            if ($node->hasAttributes()) {
                $attrsToRemove = [];
                foreach ($node->attributes as $attr) {
                    $attrName = strtolower($attr->nodeName);
                    $attrValue = trim($attr->nodeValue);

                    // Block any inline event handlers (onclick, onerror, onload, etc.)
                    if (str_starts_with($attrName, 'on') || !in_array($attrName, $allowedForTag, true)) {
                        $attrsToRemove[] = $attrName;
                        continue;
                    }

                    // Check URL protocol safety for href and src
                    if ($attrName === 'href' || $attrName === 'src') {
                        $cleanUrl = strtolower(preg_replace('/[\s\x00-\x1F\x7F]+/u', '', $attrValue));
                        if (str_starts_with($cleanUrl, 'javascript:') || 
                            str_starts_with($cleanUrl, 'vbscript:') || 
                            str_starts_with($cleanUrl, 'data:text/html')) {
                            $attrsToRemove[] = $attrName;
                            continue;
                        }
                    }

                    // Force safe rel for external targets
                    if ($tag === 'a' && $attrName === 'target' && strtolower($attrValue) === '_blank') {
                        $node->setAttribute('rel', 'noopener noreferrer');
                    }
                }
                foreach ($attrsToRemove as $attrName) {
                    $node->removeAttribute($attrName);
                }
            }
        }

        // Clean children
        $children = [];
        foreach ($node->childNodes as $child) {
            $children[] = $child;
        }
        foreach ($children as $child) {
            $cleanNode($child);
        }
    };

    $cleanNode($root);

    $cleanHtml = '';
    foreach ($root->childNodes as $child) {
        $cleanHtml .= $root->ownerDocument->saveHTML($child);
    }
    return $cleanHtml;
}

/**
 * Generate SEO-Friendly URL Slug
 *
 * @param string $text
 * @return string
 */
function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'nifara-artikel-' . time() : $text;
}
