<section>
    <article>
        <?php
        $this->startForm('action/sendMail');
        ?>
        <label for="to">
            <input name="to" placeholder="Do">
        </label>
        <label for="subject">
            <input name="subject" placeholder="Temat">
        </label>
        <label for="content">
            <textarea name="content" placeholder="treść"></textarea>
        </label>
        <input type="submit">
        <?php

        print_r($_SESSION);
        $this->endForm();
        ?>
    </article>
</section>