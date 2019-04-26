<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>
    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">
        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>
    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>
        <label class="checkbox">
            <input class="checkbox__input visually-hidden show_completed"
                <?= $show_complete_tasks == 1 ? 'checked' : '' ?> type="checkbox">
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>
    <table class="tasks">
        <?php foreach ($tasks as $key => $val) { ?>
            <tr class="tasks__item task
                <?= getDateInterval($val['date']); ?>
                <?php if ($val['status'] == 'Да') {
                if ($show_complete_tasks == 0) { ?> hidden <?php } ?> task--completed <?php } ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden" type="checkbox" checked>
                        <span class="checkbox__text">
                        	<?= htmlspecialchars($val['name']); ?>
                        </span>
                    </label>
                </td>
                <td class="task__date">
                    <?= $val['date']; ?></td>
                <td class="task__controls"><?= $val['status']; ?></td>
            </tr>
        <?php } ?>
    </table>
</main>
