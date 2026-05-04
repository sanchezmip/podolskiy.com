<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    echo "<div class='success'>Спасибо, $name! Сообщение отправлено.</div>";
}
?>
<?php include '../includes/header.php'; ?>
<main>
    <h1>Контакты</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Имя">
        <input type="email" name="email" placeholder="Email">
        <textarea name="message"></textarea>
        <button type="submit">Отправить</button>
    </form>
</main>
<?php include '../includes/footer.php'; ?>
