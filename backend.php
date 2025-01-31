<?php

// Enable error reporting for debugging (optional)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('swiftmailer/vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = '<table border="1" bordercolor="#ccc" align="center" width="650" style="width:650px;" cellpadding="10" cellspacing="0">';
    $data .= '<tr><td colspan="2" align="center" style="font-size:15px; font-weight:600;">Contact Form Enquiry Details :-</td></tr>';

    $data .= '<tr><td>Name</td><td>' . htmlspecialchars($_POST['name']) . '</td></tr>';
    $data .= '<tr><td>Email</td><td>' . htmlspecialchars($_POST['email']) . '</td></tr>';
    $data .= '<tr><td>Phone No</td><td>' . htmlspecialchars($_POST['phone']) . '</td></tr>';
    $data .= '<tr><td>Subject</td><td>' . htmlspecialchars($_POST['subject']) . '</td></tr>';
    $data .= '<tr><td>Message</td><td>' . htmlspecialchars($_POST['message']) . '</td></tr>';
    $data .= '<tr><td>IP Address</td><td>' . $_SERVER['REMOTE_ADDR'] . '</td></tr>';
    $data .= '</table>';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('mail.itarsia.co.in', 465, 'ssl'))
        ->setUsername('no-reply@itarsia.co.in')
        ->setPassword('c{2S@R+vKYiR');

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message())
        ->setSubject('Contact Form Enquiry')
        ->setFrom(['no-reply@itarsia.co.in' => 'Contact Form Enquiry'])
        ->setTo(['ekinenergy@gmail.com' => 'Contact Form Enquiry'])
        ->setBody($data)
        ->setContentType("text/html");

    // Send the message
    $result = $mailer->send($message);

    if ($result) { ?>

        <script>
            window.location.href = 'success.php';
        </script>

    <?php } else { ?>

        <script>
            window.location.href = 'failed.php';
        </script>

<?php
    }
}
?>