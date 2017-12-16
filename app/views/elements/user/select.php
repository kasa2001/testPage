<section>
    <article>
        <?php
        if ($data->isEmpty()):
            ?>
            <p>
                No data
            </p>
            <?php
        else:
            ?>
            <table>
                <thead>
                <tr>
                    <td>
                        id
                    </td>
                    <td>
                        Content
                    </td>
                    <td>
                        Created Date
                    </td>

                    <td>
                        Update Date
                    </td>
                    <td>
                        Alias
                    </td>
                    <td>
                        Title
                    </td>
                </tr>
                </thead>
                <tbody>
                <?= $this->generateDynamic($data,["tr", "td"]) ?>
                </tbody>
            </table>
            <?php
        endif;
        ?>
    </article>
</section>