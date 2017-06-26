<section>
    <article>
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
                </tr>
            </thead>
            <tbody>
            <?= $data->getDataToPage(["tr", "td"]) ?>
            </tbody>
        </table>

    </article>
</section>