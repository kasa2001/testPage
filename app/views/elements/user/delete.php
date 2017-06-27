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
                        Action
                    </td>
                </tr>
                </thead>
                <tbody>
                <?= $this->generateDynamic($data,["tr", "td"], true, "Delete") ?>
                </tbody>
            </table>
        <?php
        endif;
        ?>

    </article>
</section>