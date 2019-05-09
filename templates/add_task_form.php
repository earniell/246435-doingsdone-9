<h2 class="content__main-heading">Добавление задачи</h2>

<form class="form"  action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form__row">
        <?php $classname = isset($errors['name']) ? 'form__input--error' : '';
        $value = isset($add_task['name']) ? $add_task['name'] : ''?>
        <label class="form__label" for="name">Название <sup>*</sup></label>
        <input class="form__input <?= $classname; ?>" type="text" name="name" id="name"
               value="<?= $value; ?>" placeholder="Введите название">
        <?php if (isset($errors['name'])): ?>
            <p class="form__message"><?= $errors['name']; ?></p>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <?php $classname = isset($errors['project']) ? 'form__input--error' : '';
        $value = isset($add_task['project']) ? $add_task['project'] : '';?>
        <label class="form__label" for="project">Проект <sup>*</sup></label>

        <select class="form__input form__input--select" name="project" id="project">
            <option value="">
                Выберите задачу
            </option>
            <?php foreach ($projects as $key => $val): ?>
                <option value="<?= $val['id']; ?>">
                    <?= $val['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['project'])): ?>
            <p class="form__message"><?= $errors['project']; ?></p>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <label class="form__label" for="date">Дата выполнения</label>
        <?php $value = isset($add_task['date']) ? $add_task['date'] : '';?>
        <input class="form__input form__input--date" type="text" name="date" id="date" value="<?= $value; ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
        <?php if (isset($errors['date'])) : ?>
            <p class="form__message"><?= $errors['date']; ?></p>
        <?php endif; ?>
    </div>

    <div class="form__row">
        <label class="form__label" for="file">Файл</label>

        <div class="form__input-file">
            <?php $value = isset($add_task['file']) ? $add_task['file'] : '';?>
            <input class="visually-hidden" type="file" name="file" id="file" value="<?= $value; ?>">

            <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
            </label>
        </div>
    </div>

    <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Добавить">
    </div>
</form>