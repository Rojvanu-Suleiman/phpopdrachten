<?php

?><!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Film & Acteurs</title>
  <style>
    body{font-family:system-ui,Segoe UI,Arial,sans-serif;margin:0;background:#f6f7fb;}
    header{background:#111827;color:#fff;padding:16px 20px;}
    nav a{color:#fff;margin-right:16px;text-decoration:none;font-weight:600;}
    .container{max-width:980px;margin:20px auto;background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,.08);}
    form{display:grid;gap:12px;max-width:520px}
    input,select,button{padding:10px;border-radius:8px;border:1px solid #e5e7eb}
    button{border:none;background:#111827;color:#fff;cursor:pointer}
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;border-bottom:1px solid #eee;text-align:left}
    .muted{color:#6b7280}
  </style>
</head>
<body>
<header>
  <nav>
    <a href="index.php?route=home">Home</a>
    <a href="index.php?route=films">Films</a>
    <a href="index.php?route=actors">Acteurs</a>
    <a href="index.php?route=films_create">Film toevoegen</a>
    <a href="index.php?route=actors_create">Acteur toevoegen</a>
    <a href="index.php?route=films_link">Acteur koppelen</a>
  </nav>
</header>
<main class="container">
