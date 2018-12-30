<main class="container">
    <section class="form">
      <form method="post" action="<?= e($_SERVER['PHP_SELF']); ?>">
        <input type="text" name="title" value="<?= $formData['title']; ?>">
        <button type="submit">Отправить</button>
        <?php if (!empty($formData)): ?>
          <?php var_dump($formData); ?>
        <?php endif; ?>
      </form>
    </section>
</main>