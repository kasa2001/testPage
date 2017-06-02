<section>
    <article>
        <?= $this->startForm(""); ?>
        <input name="nick" type="text" placeholder="nick" required>
        <input name="mail" type="email" placeholder="email" required>
        <input name="password" type="password" placeholder="password" required>
        <input type="password" placeholder="repeat password" required>
        <?= $this->button("Registry"); ?>
        <?= $this->endForm(); ?>
    </article>
</section>
