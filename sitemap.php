<?php

header('Content-Type: text/xml');

$https = 'https://tierrapitaya.com';
$database = new mysqli('somosrepublica.mx', 'admin_pitaya', 'j!L5na15', 'admin_pitaya');

$xml =
'<?xml version="1.0" encoding="iso-8859-1"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>' . $https . '</loc>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>' . $https . '/properties</loc>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>' . $https . '/magazine</loc>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>' . $https . '/contact</loc>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>
</urlset>';

$database->close();

echo $xml;
