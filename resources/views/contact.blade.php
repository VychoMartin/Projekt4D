@extends('layouts.default')
@vite('resources/css/app.css')
@vite('resources/css/main.css')
@section('header')
<div class="contact"><h1>Kontakty</h1>
<h2>Správce</h2>
<div class="contactBlok"><?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=Projekt4D;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->prepare('SELECT name, surname, email, phone FROM users WHERE role = :role LIMIT 1');
    $stmt->execute(['role' => 'spravce']);
    $spravce = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $spravce = null;
}?>
<?php if ($spravce): ?>
            <ul class="contact-list-spravce">
                <li class="contact-name">
                    <i class="bi bi-person-circle"></i>
                    <span><?= htmlspecialchars($spravce['name'] . ' ' . $spravce['surname']) ?></span>
                </li>
                <li>
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $spravce['phone'])) ?>">
                        <?= htmlspecialchars($spravce['phone']) ?>
                    </a>
                </li>
                <li>
                    <i class="bi bi-envelope-fill"></i>
                    <a href="mailto:<?= htmlspecialchars($spravce['email']) ?>">
                        <?= htmlspecialchars($spravce['email']) ?>
                    </a>
                </li>
            </ul>
        <?php else: ?>
            <p class="contact-unavailable">
                <i class="bi bi-exclamation-circle"></i> Kontakt je momentálně nedostupný.
            </p>
        <?php endif; ?>
    </div>
    <h2>Technici</h2>
    <div class="contactBlok">
<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=Projekt4D;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->prepare('SELECT name, surname, email, phone, specializace FROM users WHERE role = :role ORDER BY surname, name');
    $stmt->execute(['role' => 'technik']);
    $technici = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $technici = [];
}
?>

<?php if ($technici): ?>
    <?php foreach ($technici as $technik): ?>
        <ul class="contact-list">
    <li class="contact-name">
        <i class="bi bi-person-circle"></i>
        <span><?= htmlspecialchars($technik['name'] . ' ' . $technik['surname']) ?></span>
    </li>
    <li>
        <i class="bi bi-telephone-fill"></i>
        <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $technik['phone'])) ?>">
            <?= htmlspecialchars($technik['phone']) ?>
        </a>
    </li>
    <li>
        <i class="bi bi-envelope-fill"></i>
        <a href="mailto:<?= htmlspecialchars($technik['email']) ?>">
            <?= htmlspecialchars($technik['email']) ?>
        </a>
    </li>
    <?php if (!empty($technik['specializace'])): ?>
        <li>
            <i class="bi bi-gear"></i>
            <span><?= htmlspecialchars($technik['specializace']) ?></span>
        </li>
    <?php endif; ?>
</ul>
    <?php endforeach; ?>
<?php else: ?>
    <p class="contact-unavailable">
        <i class="bi bi-exclamation-circle"></i> Kontakt je momentálně nedostupný.
    </p>
<?php endif; ?>
</div>
</div>

    
    
@endsection
@section('maincontent')

@endsection
    @section('footer')
        
    @endsection
