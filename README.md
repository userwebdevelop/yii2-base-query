# Что делает пакет
Пакет добавляет столбцы `og_title, og_description, og_url, og_image` в таблицу pages и такие же значения в таблицу config.
# После установки пакета необходимо сделать следующие шаги (порядок не важен):
- В файле `console/config/main.php` добавить следующий код:
```php
'controllerMap' => [
    //остальной код
    'userwebdevelop' => 'userwebdevelop\OgConfigPages'
];
```

- В файле `common/models/Page.php` в метод `rules()` добавить

 ```[['og_description', 'og_image', 'og_title', 'og_url'], 'string']```

- В файле `common/models/Page.php` в метод `attributeLabels()` добавить
```php
'og_title' => Yii::t('models', 'OpenGraph Title'),
'og_description' => Yii::t('models', 'OpenGraph Description'),
'og_url' => Yii::t('models', 'OpenGraph Url'),
'og_image' => Yii::t('models', 'OpenGraph Image'),
```

 - В файле `backend\modules\admin\views\page\_form.php` добавить
 ```php
<?= $form->field($model, 'og_title')->textInput() ?>
<?= $form->field($model, 'og_description')->textarea(['rows' => 3]) ?>
<?= $form->field($model, 'og_url')->textInput() ?>
<?= $form->field($model, 'og_image')->textInput() ?>
 ```
 - В файле `backend\modules\admin\views\page\view.php` добавить
 ```php
'og_title'
'og_description'
'og_url'
'og_image'
 ```

# Команды
`php yii userwebdevelop/install` - добавление функционала opengraph

`php yii userwebdevelop/uninstall` - удаление функционала opengraph
