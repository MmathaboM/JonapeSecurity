<?php
    // Validate and sanitize inputs
    $to = "mmathabom99@gmail.com";
    $from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_REQUEST['name']);
    $number = htmlspecialchars($_REQUEST['number']);
    $cmessage = htmlspecialchars($_REQUEST['message']);
    $csubject = htmlspecialchars($_REQUEST['subject']); // Fixed variable name

    // Set headers properly
    $headers = array(
        'From' => $from,
        'Reply-To' => $from,
        'MIME-Version' => '1.0',
        'Content-Type' => 'text/html; charset=UTF-8'
    );

    // Create email body
    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt='Logo'></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$csubject}</td></tr>";
    $body .= "<tr><td style='border:none;'><strong>Phone:</strong> {$number}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // Send email
    $send = mail($to, $subject, $body, implode("\r\n", $headers));

    // Return result
    echo json_encode(['success' => $send]);
?>