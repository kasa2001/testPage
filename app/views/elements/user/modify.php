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
                <td>
                    Action
                </td>
            </tr>
            </thead>
            <tbody>
            <?= $data->getDataToPage(["tr", "td"], true, "Edit") ?>
            </tbody>
        </table>

    </article>
</section>