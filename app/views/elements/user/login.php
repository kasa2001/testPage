<section>
    <article>
        <?= $this->startForm("home/index");?>
        <input name="nick" type="text" placeholder="nick" required>
        <input name="password" type="password" placeholder="password" required>
        <?=$this->button("Logowanie");?>
        <?= $this->endForm();?>
    </article>
</section>