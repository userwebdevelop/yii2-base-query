Расширение ActiveQuery для более удобной фильтрации и сортировки.

для установки нужно в `/common/config/bootstrap.php` добавить следующий код:
```php
Yii::$container->set(
    \yii\db\ActiveQuery::class,
    function ($container, $params) {
        return new \userwebdevelop\yii2BaseQuery\BaseQuery($params[0]);
    }
);
```

activeAndSorted() — активные + сортировка по sort и id.
active() — выборка только со status = 1.
sortedBySort() — сортировка по sort ASC, id DESC.
sortedByAttribute($attribute, $sortType = SORT_DESC) — сортировка по атрибуту + id DESC.

Можно добавлять свои подобные методы, упрощающие работу с ORM в Yii2