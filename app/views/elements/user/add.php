<section>
    <article>
        <div>
        </div>
        <?=$this->startForm(); ?>
        <label for="text">
            <input type="text" id="text">
        </label>
        <label for="alias">
            <input type="text" id="alias">
        </label>
        <label for="title">
            <input type="text" id="title">
        </label>
        <?= $this->button("Add data");?>
        <?= $this->endForm(); ?>
    </article>
</section>