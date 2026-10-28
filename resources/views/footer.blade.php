<?php
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
}
?>
<footer class="footer">
    <div class="footer-contact">
        <h3 class="footer-title">
            <i class="bi bi-headset"></i> Kontakt na správce
        </h3>

        <?php if ($spravce): ?>
            <ul class="contact-list-footer">
                <li>
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

    <div class="row footer-bottom">
        <a href="#"><i class="bi bi-file-earmark-text"></i> Terms of Service</a>
        <p>&copy; 2026 Hlášení Poruch. Všechna práva vyhrazena.</p>
        <a href="#"><i class="bi bi-shield-lock"></i> Privacy Policy</a>
    </div>
</footer>